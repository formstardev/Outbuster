<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Plan as localPlan;
use Stripe\Stripe;
use Stripe\Product;
use Stripe\Plan as StripePlan;

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

class PlansTableSeeder extends Seeder
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
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        localPlan::truncate();

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $stripe_product = Product::create([
            "name" => 'Monthly Plan',
            "description" => 'Monthly Plan',
        ]);

        $stripe_plan = StripePlan::create(array(
            "amount" => 600,
            "interval" => "month",
            "product" => $stripe_product['id'],
            "currency" => 'eur',
            "interval_count" => 1,
        ));

        // Create a new billing plan
        $paypal_plan_id = '';
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
        $merchantPreferences->setReturnUrl(route('paypal.return', '1'))
            ->setCancelUrl(route('paypal.cancel', '1'))
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
                $paypal_plan_id = $plan->getId();
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

        localPlan::create([
            'id' => '1',
            'name' => 'Abonnement mensuel de 30 jours',
            'description' => 'Abonnement mensuel de 30 jours',
            'frequency' => 'Month',
            'amount' => 5.99,
            'currency' => 'EUR',
            'free_period' => '0',
            'payment_period' => '30',
            'payment_recurring' => '0',
            'stripe_prod_id' => $stripe_product['id'],
            'stripe_plan_id' => $stripe_plan['id'],
            'paypal_plan_id' => $paypal_plan_id,
            'status' => 1,
        ]);

        $stripe_product = Product::create([
            "name" => 'Yearly Plan',
            "description" => 'Yearly Plan',
        ]);

        $stripe_plan = StripePlan::create(array(
            "amount" => 6000,
            "interval" => "year",
            "product" => $stripe_product['id'],
            "currency" => 'eur',
            "interval_count" => 1,
        ));

        // Create a new billing plan
        $paypal_plan_id = '';
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
            ->setAmount(new Currency(array('value' => 60, 'currency' => 'EUR')));

        // Set merchant preferences
        $merchantPreferences = new MerchantPreferences();
        $merchantPreferences->setReturnUrl(route('paypal.return', '2'))
            ->setCancelUrl(route('paypal.cancel', '1'))
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
                $paypal_plan_id = $plan->getId();
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
        localPlan::create([
            'id' => '2',
            'name' => 'Abonnement annuel de 365 jours',
            'description' => 'Abonnement annuel de 365 jours',
            'frequency' => 'Year',
            'amount' => 59.99,
            'currency' => 'EUR',
            'free_period' => '0',
            'payment_period' => '365',
            'payment_recurring' => '0',
            'stripe_prod_id' => $stripe_product['id'],
            'stripe_plan_id' => $stripe_plan['id'],
            'status' => 1,
        ]);
    }
}
