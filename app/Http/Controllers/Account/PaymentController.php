<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\Transactions;
use Illuminate\Support\Facades\Auth;
use PayPal\Api\Agreement;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

class PaymentController extends Controller
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
     * Show Profile View.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $page_name = 'payment';
        $current_plan = $user->current_plan();
        if($current_plan){
            if($current_plan->subscriptions_type == 'paypal'){        
                $agreement_check = Agreement::get($current_plan->stripe_id, $this->apiContext);
                $agreement_details = $agreement_check->getAgreementDetails();
                $next_time = $agreement_details->getNextBillingDate();
    
            }else{
                $timestamp = $user->subscription('default')->asStripeSubscription()->current_period_end;
                $next_time = date('Y-m-d', $timestamp);
            }
        }else{
            $next_time = NULL;
        }
        $transactions = Transactions::select('transactions.*')->join('plans', 'plans.id', 'transactions.plan_id', 'left')
            ->where('transactions.user_id', $user->id)
            ->orderby('transactions.created_at', 'DESC')
            ->get();
        return view('accounts.payment.index', compact('page_name', 'current_plan', 'next_time', 'transactions', 'user'));
    }
}
