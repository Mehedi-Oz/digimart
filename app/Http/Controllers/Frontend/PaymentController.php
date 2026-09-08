<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class PaymentController extends Controller
{
    public function completed()
    {
        return view('frontend.pages.order-completed');
    }

    public function canceled()
    {
        return view('frontend.pages.order-canceled');
    }

    public function setPaypalConfig(): array
    {
        return [
            'mode'    => config('settings.paypal_mode'),
            'sandbox' => [
                'client_id'     => config('settings.paypal_client_id'),
                'client_secret' => config('settings.paypal_secret_key'),
                'app_id'        => 'APP-80W284485P519543T',
            ],
            'live' => [
                'client_id'     => config('settings.paypal_client_id'),
                'client_secret' => config('settings.paypal_secret_key'),
                'app_id'        => config('settings.paypal_app_id'),
            ],
            'payment_action'  => 'sale',
            'currency'        => config('settings.default_currency'),
            'notify_url'      => '',
            'locale'          => 'en_US',
            'validate_ssl'    => true,
            // 'timeout'         => env('PAYPAL_TIMEOUT', 30),
            // 'connect_timeout' => env('PAYPAL_CONNECT_TIMEOUT', 10),
            // 'max_retries'     => env('PAYPAL_MAX_RETRIES', 2),
        ];
    }

    public function payWithPaypal(): RedirectResponse
    {
        $payableAmount = getCartTotal();

        $config = $this->setPaypalConfig();

        $provider = new PayPalClient($config);
        $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => config('settings.default_currency'),
                        "value" => $payableAmount,
                    ],
                ],
            ],
            "application_context" => [
                "cancel_url" => route('payment.paypal.cancel'),
                "return_url" => route('payment.paypal.success'),
            ],
        ]);

        if (
            isset($response['id']) &&
            isset($response['status']) &&
            $response['status'] === 'CREATED'
        ) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        }

        return redirect()
            ->route('payment.paypal.cancel')
            ->with('error', 'Unable to create PayPal payment.');
    }

    public function paypalSuccess(Request $request): RedirectResponse
    {
        $config = $this->setPaypalConfig();
        $provider = new PayPalClient($config);
        $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request->token);
        $order = $response['purchase_units'][0]['payments']['captures'][0];
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            OrderService::storeOrder(
                paymentId: $order['id'],
                paidInAmount: $order['amount']['value'],
                paidInCurrencyIcon: $order['amount']['currency_code'],
                paymentGateway: 'PayPal',
                exchangeRate: 1,
            );
            return redirect()->route('payment.completed');
        }
    }

    public function paypalCancel(Request $request): RedirectResponse
    {
        return redirect()->route('payment.canceled');
    }

    public function payWithStripe(): RedirectResponse
    {
        $payableAmount = (getCartTotal() * 100);

        Stripe::setApiKey(config('settings.stripe_secret_key'));

        $response = StripeSession::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => config('settings.default_currency'),
                        'product_data' => [
                            'name' => 'Product Purchase',
                        ],
                        'unit_amount' => $payableAmount,
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('payment.stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('payment.stripe.cancel'),
        ]);

        return redirect($response->url);
    }


    public function stripeSuccess(Request $request): RedirectResponse
    {

        abort_if(!$request->has('session_id'), 400, 'Session ID is required.');

        Stripe::setApiKey(config('settings.stripe_secret_key'));

        $response = StripeSession::retrieve($request->session_id);
        if ($response->payment_status === 'paid') {
            OrderService::storeOrder(
                paymentId: $response->payment_intent,
                paidInAmount: $response->amount_total / 100,
                paidInCurrencyIcon: $response->currency,
                paymentGateway: 'Stripe',
                exchangeRate: 1,
            );
            return redirect()->route('payment.completed');
        }
    }

    public function stripeCancel(Request $request): RedirectResponse
    {
        return redirect()->route('payment.canceled');
    }
}
