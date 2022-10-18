<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan as localPlan;
use App\Models\Subscription;
use App\Models\Transactions;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Subscription as CashierSubscription;
use Illuminate\Support\Str;

// Used to process plans
use PayPal\Api\ChargeModel;
use PayPal\Api\Currency;
use PayPal\Api\MerchantPreferences;
use PayPal\Api\PaymentDefinition;
use PayPal\Api\Plan;
use PayPal\Api\Patch;
use PayPal\Api\PatchRequest;
use PayPal\Common\PayPalModel;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Agreement;
use PayPal\Api\Payer;
use PayPal\Api\ShippingAddress;

class SubscriptionController extends Controller
{
    private $apiContext;
    private $mode;
    private $client_id;
    private $secret;

    // Create a new instance with our paypal credentials
    public function __construct()
    {

        // Detect if we are running in live mode or sandbox
        if (config('paypal.settings.mode') == 'live') {
            $this->client_id = config('paypal.live_client_id');
            $this->secret = config('paypal.live_secret');
        } else {
            $this->client_id = config('paypal.sandbox_client_id');
            $this->secret = config('paypal.sandbox_secret');
        }

        // Set the Paypal API Context/Credentials
        $this->apiContext = new ApiContext(new OAuthTokenCredential($this->client_id, $this->secret));
        $this->apiContext->setConfig(config('paypal.settings'));

        // Stripe::setApiKey(env('STRIPE_SECRET'));
    }
    /**
     * Show Subscription view.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_name = 'subscription';
        $user = User::find(Auth::user()->id);
        $current_plan = $user->current_plan();
        if (!$current_plan || !is_null($current_plan->ends_at)) return redirect()->route('account.subscription.create');
        if($current_plan->subscriptions_type == 'paypal'){        
            $agreement_check = Agreement::get($current_plan->stripe_id, $this->apiContext);
            $agreement_details = $agreement_check->getAgreementDetails();
            $next_time = $agreement_details->getNextBillingDate();

        }else{
            $timestamp = $user->subscription('default')->asStripeSubscription()->current_period_end;
            $next_time = date('Y-m-d', $timestamp);
        }


        return view('accounts.subscription.subscription', compact('page_name', 'next_time',  'current_plan', 'user'));
    }
    /**
     * Show Payment view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_name = 'subscription';
        $current_plan = Auth::user()->current_plan();
        return view('accounts.subscription.subscription-create', compact('page_name', 'current_plan'));
    }

    /**
     * Show Type view.
     *
     * @return \Illuminate\Http\Response
     */
    public function type()
    {
        $page_name = 'subscription';
        $plans = localPlan::where('status', '1')->get();
        return view('accounts.subscription.subscription-type', compact('page_name', 'plans'));
    }

    public function cancel(Request $request)
    {
        $user = Auth::user();
        $current_plan = $user->current_plan();
        if (!$current_plan || !is_null($current_plan->ends_at)) return redirect()->route('account.subscription.create');
        if($current_plan->subscriptions_type == 'paypal'){        
            $agreement_check = Agreement::get($current_plan->stripe_id, $this->apiContext);
            $agreement_details = $agreement_check->getAgreementDetails();
            $next_time = $agreement_details->getNextBillingDate();
            
            Subscription::where('user_id',$user->id)->update(['ends_at'=>date("Y-m-d H:i:s",strtotime($next_time))]);

        }else{
            $user->subscription('default')->cancel();
        }

        return true;
    }
    /**
     * Show Payment view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function paymentManage(Request $request)
    {
        $page_name = 'subscription';
        return view('accounts.payment.manage', compact('page_name'));
    }


    public function stripeRedirect($planId, Request $request)
    {
        $localPlan = localPlan::where('stripe_plan_id', $planId)->get()->last();

        if (!$localPlan) {
            echo "Plan not found.";
        }
        return view('accounts.subscription.stripe', [
            'intent' => auth()->user()->createSetupIntent(),
            'planId' => $planId,
            'try_out_trial' => $request->try_out_trial == 'true' ? true : false,
            'localPlan' => $localPlan
        ]);
    }

    public function stripeSubscribe(Request $request)
    {
        $planID = $request->planID;
        $paymentMethod = $request->paymentMethod;
        $user = auth()->user();
        $checkSubscription = $user->checkSubscription();
        $localPlan = localPlan::where('stripe_plan_id', $planID)->get()->last();

        if (!$localPlan) {
            return response()->json(['errors' => 'Plan not found.'], 422);
        }


        try {
            if ($checkSubscription) {
                $user->subscription('default')->swap($planID);
                $stripe_id = $checkSubscription->stripe_id;
            } else {
                $response = $user->newSubscription('default', $planID)->create($paymentMethod, [
                    'email' => $user->email
                ]);
                $stripe_id = $response->stripe_id;
            }
            $timestamp = $user->subscription('default')->asStripeSubscription()->current_period_end;
            $expiration_date =  date('Y-m-d', $timestamp);//date('Y-m-d', strtotime('+' . $localPlan->payment_period . ' day', time()));
            $transaction = Transactions::create([
                'user_id' => $user->id,
                'payment_method' => '0',
                'amount' => $localPlan->amount,
                'plan_id' => $localPlan->id,
                'expiration_date' => $expiration_date,
                'transaction_id' => $stripe_id
            ]);

            return response()->json(
                [
                    'success' => true,
                    'status' => '200',
                    'message' => 'Subcription addedd successfully'
                ]
            );
        } catch (\Exception $e) {
            return response()->json(['errors' => $e->getMessage(), $e->getTrace()], 422);
        }
    }

    public function stripeTrial(Request $request)
    {
        $planID = $request->planID;
        $paymentMethod = $request->paymentMethod;
        $user = auth()->user();
        // $localPlan = LocalPlan::find($planID);
        $checkSubscription = $user->checkSubscription();

        try {
            if ($checkSubscription) {
                $user->subscription('default')->swap($planID);
            } else {
                $response = $user->newSubscription('default', $planID)->trialDays(14)->create($paymentMethod, [
                    'email' => $user->email
                ]);
            }
            return response()->json(['success' => 'Subcription addedd successfully', 200]);
        } catch (\Exception $e) {
            response()->json(['errors' => $e->getMessage()], 422);
        }
    }


    public function create_plan()
    {

        // Create a new billing plan
        $plan = new Plan();
        $plan->setName('App Name Monthly Billing')
            ->setDescription('Monthly Subscription to the App Name')
            ->setType('infinite');

        // Set billing plan definitions
        $paymentDefinition = new PaymentDefinition();
        $paymentDefinition->setName('Regular Payments')
            ->setType('REGULAR')
            ->setFrequency('Month')
            ->setFrequencyInterval('1')
            ->setCycles('0')
            ->setAmount(new Currency(array('value' => 6, 'currency' => 'EUR')));

        // Set merchant preferences
        $merchantPreferences = new MerchantPreferences();
        $merchantPreferences->setReturnUrl(route('paypal.return'))
            ->setCancelUrl(route('paypal.cancel'))
            ->setAutoBillAmount('yes')
            ->setInitialFailAmountAction('CONTINUE')
            ->setMaxFailAttempts('0');

        $plan->setPaymentDefinitions(array($paymentDefinition));
        $plan->setMerchantPreferences($merchantPreferences);

        //create the plan
        try {
            $createdPlan = $plan->create($this->apiContext);

            try {
                $patch = new Patch();
                $value = new PayPalModel('{"state":"ACTIVE"}');
                $patch->setOp('replace')
                    ->setPath('/')
                    ->setValue($value);
                $patchRequest = new PatchRequest();
                $patchRequest->addPatch($patch);
                $createdPlan->update($patchRequest, $this->apiContext);
                $plan = Plan::get($createdPlan->getId(), $this->apiContext);

                // Output plan id
                echo 'Plan ID:' . $plan->getId();
            } catch (PayPal\Exception\PayPalConnectionException $ex) {
                echo $ex->getCode();
                echo $ex->getData();
                die($ex);
            } catch (Exception $ex) {
                die($ex);
            }
        } catch (PayPal\Exception\PayPalConnectionException $ex) {
            echo $ex->getCode();
            echo $ex->getData();
            die($ex);
        } catch (Exception $ex) {
            die($ex);
        }
    }

    public function paypalRedirect($planId)
    {
        // Create new agreement
        $agreement = new Agreement();
        $agreement->setName('App Name Monthly Subscription Agreement')
            ->setDescription('Basic Subscription')
            ->setStartDate(\Carbon\Carbon::now()->addMinutes(5)->toIso8601String());

        // Set plan id
        $plan = new Plan();
        $plan->setId($planId);
        $agreement->setPlan($plan);

        // Add payer type
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $agreement->setPayer($payer);

        try {
            // Create agreement
            $agreement = $agreement->create($this->apiContext);

            // Extract approval URL to redirect user
            $approvalUrl = $agreement->getApprovalLink();

            return redirect($approvalUrl);
        } catch (PayPal\Exception\PayPalConnectionException $ex) {
            echo $ex->getCode();
            echo $ex->getData();
            die($ex);
        } catch (Exception $ex) {
            die($ex);
        }
    }

    public function paypalReturn($localPlanId, Request $request)
    {
        $localPlan = localPlan::where('id',$localPlanId)->first();

        $token = $request->token;
        $agreement = new Agreement();

        try {
            // Execute agreement
            $result = $agreement->execute($token, $this->apiContext);
            $user = Auth::user();
            if (isset($result->id)) {
                Subscription::where('user_id',$user->id)->delete();

                $subscription = Subscription::create([
                    'user_id' => $user->id,
                    'name' => 'paypal',
                    'stripe_id' => $result->id,
                    'stripe_status' => 'active',
                    'quantity' => '1',
                    'stripe_price' => $localPlan->stripe_plan_id,
                ]);

                $agreement_check = Agreement::get( $result->id, $this->apiContext);
                $agreement_details = $agreement_check->getAgreementDetails();
                $expiration_date = $agreement_details->getNextBillingDate();

                $transaction = Transactions::create([
                    'user_id' => $user->id,
                    'payment_method' => '0',
                    'amount' => $localPlan->amount,
                    'plan_id' => $localPlan->id,
                    'expiration_date' => $expiration_date,//date('Y-m-d', strtotime($result->agreement_details->next_billing_date)),
                    'transaction_id' => $result->id,
                ]);
            } else {
                return back()->withErrors('Can not find agreement id.');
            }

            return redirect()->route('account.subscription');

        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            return back()->withErrors(
                'You have either cancelled the request or your session has expired'
            );
        }
    }

    public function paypalCancel($getAgreementId, Request $request)
    {

        $agreementId = $getAgreementId;
        $agreement = new Agreement();
        $agreement->setId($agreementId);

        $agreementStateDescriptor = new AgreementStateDescriptor();
        $agreementStateDescriptor->setNote("Cancel the agreement");

        try {

            // $agreement = Agreement::get($agreement->getId(), $this->apiContext);
            // $details = $agreement->getAgreementDetails();
            // $payer = $agreement->getPayer();
            // $payerInfo = $payer->getPayerInfo();
            // $plan = $agreement->getPlan();
            // $payment = $plan->getPaymentDefinitions()[0];

            $agreement->cancel($agreementStateDescriptor, $this->apiContext);

            return redirect()->route('account.subscription.type')
                ->with('success', 'Cancel Subscription has been successfully!');
        } catch (Exception $ex) {
            echo "Failed to get activate";
            var_dump($ex);
            exit();
        }
    }
}
