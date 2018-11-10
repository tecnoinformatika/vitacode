<?php namespace Ideas\Shop\Components;

use Cms\Classes\ComponentBase;
use Ideas\Shop\Models\Config;
use Ideas\Shop\Models\Coupon;
use Ideas\Shop\Models\IdeasShop;
use Ideas\Shop\Models\Ship;
use Auth;
use Illuminate\Support\Facades\File;

class Checkout extends ComponentBase
{
    public $checkout_error;

    const PAYPAL_SANDBOX = 0;
    const PAYPAL_PRODUCTION = 1;

    const CASH_ON_DELIVERY = 1;
    const PAYPAL = 2;
    const STRIPE = 3;

    public function componentDetails()
    {
        return [
            'name' => 'Ideas Shop Check out',
            'description' => 'check out'
        ];
    }

    public function onRun()
    {
        $get = get();
        $currency = Config::getCurrencySymbol();
        $paypalMode = Config::getConfigByKey('paypal_mode');
        if ($paypalMode == self::PAYPAL_SANDBOX) {
            $paypalUrl = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
        } else {
            $paypalUrl = 'https://www.paypal.com/cgi-bin/webscr';
        }
        $this->page['currency_code'] = $currency['code'];
        $this->page['ship'] = Ship::all();
        $this->page['paypalURL'] = $paypalUrl; //sandbox
        $this->page['enable'] = IdeasShop::ENABLE;
        $this->page['disable'] = IdeasShop::DISABLE;
        $this->page['paypal'] = Config::getConfigByKey('paypal');
        $this->page['stripe'] = Config::getConfigByKey('stripe');
        $this->page['paypalID'] = Config::getConfigByKey('paypal_id'); //paypal email of receiver
        $this->page['paypalCancel'] = url('/paypal/cancel');
        $this->page['paypalSuccess'] = url('/paypal/success');
        $this->page['tokenPaypal'] = !empty($get['token']) ? $get['token'] : '';
        $this->page['stripe_publish'] = Config::getConfigByKey('stripe_publish');
        $this->page['const_is_login'] = \Ideas\Shop\Facades\Order::IS_LOGIN;
        $this->page['const_not_login'] = \Ideas\Shop\Facades\Order::NOT_LOGIN;
        $this->page['checkout_error'] = $this->checkout_error;
        $this->page['checkout_ok_url'] = Config::getConfigByKey('checkout_ok_url');
        $this->page['checkout_fail_url'] = Config::getConfigByKey('checkout_fail_url');
        $this->addJs('/plugins/ideas/shop/assets/components/js/jquery.validate.js');
        $this->addJs('/plugins/ideas/shop/assets/components/js/checkout.js');
    }

    /**
     * Check coupon ajax
     */
    public function onCheckCoupon()
    {
        $post = post();
        $coupon = $post['coupon'];
        $couponData = Coupon::where('code', $coupon)->first();
        $loggedIn = Auth::getUser();
        if (!empty($couponData)) {
            $discount = \Ideas\Shop\Facades\Coupon::
                calculateDiscountPrice($couponData, $post['totalPrice'], $post['cart'], $loggedIn);
        } else {
            $discount =  [
                'rs' => false,
                'error'=> trans('ideas.shop::lang.error_coupon.not_exists'),
                'discount_price' => 0
            ];
        }
        return response()->json($discount);
    }

    /**
     * Checkout stripe
     */
    public function onCheckOutStripe()
    {
        $post = post();
        $token = $post['tokenVar'];
        $params = $post['params'];
        $totalPriceByCent = $params['total'] * 100;
        $success = 0;
        File::requireOnce(plugins_path('ideas/shop/lib/vendor/stripe/stripe-php/init.php'));
        try {
            \Stripe\Stripe::setApiKey(Config::getConfigByKey('stripe_secret'));
            $charge = \Stripe\Charge::create(array(
                'amount' => $totalPriceByCent, // Amount in cents!
                'currency' => strtolower($params['currency_code']),
                'source' => $token,
                'description' => 'Checkout by stripe'
            ));
            $success = IdeasShop::SUCCESS;
            //save order then send email
            $orderId = $this->saveOrderGetParams($params);
            \Ideas\Shop\Facades\Order::changeStatusPaymentToPaid($orderId);
            return response()->json(IdeasShop::SUCCESS);
        } catch (\Stripe\Error\ApiConnection $e) {
            $stripeError = e(trans('ideas.shop::lang.shop.network_error'));
        } catch (\Stripe\Error\Card $e) {
            // Card was declined.
            $eJson = $e->getJsonBody();
            $error = $eJson['error'];
            $stripeError = $error['message'];
        }
        if ($success != 1) {
            $this->checkout_error = $stripeError;
            return response()->json($stripeError);
        }
    }

    /**
     * Convert form payment
     */
    public function convertFormPaymentInfo($data)
    {
        $rs = [];
        foreach ($data as $row) {
            $rs[$row['name']][] = $row['value'];
        }
        return $rs;
    }

    /**
     * Save order get params
     */
    public function saveOrderGetParams($params)
    {
        $formPaymentInfo = $params['form_payment_not_login'];
        $formPaymentInfo = $this->convertFormPaymentInfo($formPaymentInfo);
        $orderId = \Ideas\Shop\Facades\Order::saveOrder($params, $formPaymentInfo);
        return $orderId;
    }

    /**
     * On save order
     */
    public function onSaveOrder()
    {
        $post = post();
        $orderId = $this->saveOrderGetParams($post);
        return response()->json($orderId);
    }

    /**
     * Paypal success
     */
    public function onPaypalSuccess()
    {
        $post = post();
        $token = $post['token'];
        $tokenArray = explode('_', $token);
        $orderId = $tokenArray[1];
        \Ideas\Shop\Facades\Order::changeStatusPaymentToPaid($orderId);
    }
}
