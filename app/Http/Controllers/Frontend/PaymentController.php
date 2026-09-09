<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Services\OrderService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Razorpay\Api\Api as RazorpayApi;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Stripe;

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
            'mode' => config('settings.paypal_mode'),
            'sandbox' => [
                'client_id' => config('settings.paypal_client_id'),
                'client_secret' => config('settings.paypal_secret_key'),
                'app_id' => 'APP-80W284485P519543T',
            ],
            'live' => [
                'client_id' => config('settings.paypal_client_id'),
                'client_secret' => config('settings.paypal_secret_key'),
                'app_id' => config('settings.paypal_app_id'),
            ],
            'payment_action' => 'sale',
            'currency' => config('settings.default_currency'),
            'notify_url' => '',
            'locale' => 'en_US',
            'validate_ssl' => true,
        ];
    }

    public function payWithPaypal(): RedirectResponse
    {
        $payableAmount = getCartTotal();

        $config = $this->setPaypalConfig();

        $provider = new PayPalClient($config);
        $provider->getAccessToken();

        $response = $provider->createOrder([
            'intent' => 'CAPTURE',
            'purchase_units' => [
                [
                    'amount' => [
                        'currency_code' => config('settings.default_currency'),
                        'value' => $payableAmount,
                    ],
                ],
            ],
            'application_context' => [
                'cancel_url' => route('payment.paypal.cancel'),
                'return_url' => route('payment.paypal.success'),
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
        abort_if(! $request->has('token'), 400, 'Payment token is required.');

        $config = $this->setPaypalConfig();
        $provider = new PayPalClient($config);
        $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request->token);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $order = $response['purchase_units'][0]['payments']['captures'][0];

            $alreadyProcessed = Transaction::where('payment_id', $order['id'])->exists();
            if ($alreadyProcessed) {
                return redirect()->route('payment.completed');
            }

            OrderService::storeOrder(
                paymentId: $order['id'],
                paidInAmount: $order['amount']['value'],
                paidInCurrencyIcon: $order['amount']['currency_code'],
                paymentGateway: 'PayPal',
                exchangeRate: 1,
            );

            return redirect()->route('payment.completed');
        }

        return redirect()->route('payment.canceled');
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
            'success_url' => route('payment.stripe.success').'?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('payment.stripe.cancel'),
        ]);

        return redirect($response->url);
    }

    public function stripeSuccess(Request $request): RedirectResponse
    {
        abort_if(! $request->has('session_id'), 400, 'Session ID is required.');

        Stripe::setApiKey(config('settings.stripe_secret_key'));

        $response = StripeSession::retrieve($request->session_id);

        if ($response->payment_status === 'paid') {
            $alreadyProcessed = Transaction::where('payment_id', $response->payment_intent)->exists();
            if ($alreadyProcessed) {
                return redirect()->route('payment.completed');
            }

            OrderService::storeOrder(
                paymentId: $response->payment_intent,
                paidInAmount: $response->amount_total / 100,
                paidInCurrencyIcon: $response->currency,
                paymentGateway: 'Stripe',
                exchangeRate: 1,
            );

            return redirect()->route('payment.completed');
        }

        return redirect()->route('payment.canceled');
    }

    public function stripeCancel(Request $request): RedirectResponse
    {
        return redirect()->route('payment.canceled');
    }

    public function razorpayRedirect(): View
    {
        return view('frontend.pages.razorpay-redirect');
    }

    public function payWithRazorpay(Request $request): RedirectResponse
    {
        if (! $request->filled('razorpay_payment_id')) {
            return redirect()->route('payment.canceled');
        }

        try {
            $api = new RazorpayApi(
                config('settings.razorpay_key'),
                config('settings.razorpay_secret_key')
            );

            $payableAmount = round(getCartTotal() * config('settings.razorpay_currency_rate') * 100);

            $payment = $api->payment->fetch($request->razorpay_payment_id);
            $response = $payment->capture([
                'amount' => $payableAmount,
            ]);

            if ($response->status === 'captured') {
                $alreadyProcessed = Transaction::where('payment_id', $response->id)->exists();
                if ($alreadyProcessed) {
                    return redirect()->route('payment.completed');
                }

                OrderService::storeOrder(
                    paymentId: $response->id,
                    paidInAmount: $response->amount / 100,
                    paidInCurrencyIcon: $response->currency,
                    paymentGateway: 'Razorpay',
                    exchangeRate: config('settings.razorpay_currency_rate'),
                );

                return redirect()->route('payment.completed');
            }

            return redirect()->route('payment.canceled');
        } catch (\Exception $e) {
            return redirect()->route('payment.canceled');
        }
    }

    public function razorpaySuccess(Request $request): RedirectResponse
    {
        return redirect()->route('payment.completed');
    }

    public function razorpayCancel(): RedirectResponse
    {
        return redirect()->route('payment.canceled');
    }
}
