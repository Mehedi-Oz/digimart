<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Razorpay</title>
    <style>
        .razorpay-payment-button {
            display: none;
        }
    </style>
</head>

<body>
    @php
        $payableAmount = round(getCartTotal() * config('settings.razorpay_currency_rate') * 100);
    @endphp

    <form action="{{ route('payment.razorpay') }}" class="razorpay-payment-form">
        @csrf
        <input type="hidden" value="" class="razorpay_payment_id" name="razorpay_payment_id">
    </form>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <script>
        var options = {
            key: "{{ config('settings.razorpay_key') }}",
            currency: "{{ config('settings.razorpay_currency') }}",
            amount: "{{ $payableAmount }}",
            name: "{{ config('settings.site_name') }}",
            description: "Payment for the product",
            image: "{{ config('settings.site_logo') }}",
            theme: {
                color: "#F37254"
            },
            modal: {
                ondismiss: function() {
                    window.location.href = "{{ route('payment.canceled') }}";
                }
            },
            handler: function(response) {
                document.querySelector('.razorpay_payment_id').value = response.razorpay_payment_id;
                document.querySelector('.razorpay-payment-form').submit();
            }
        }

        var rzp = new Razorpay(options);
        rzp.open();
    </script>
</body>

</html>
