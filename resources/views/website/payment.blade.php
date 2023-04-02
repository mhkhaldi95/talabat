@extends('website.layout.master')
@section('head')
    <!-- Moyasar Styles -->
    <link rel="stylesheet" href="https://cdn.moyasar.com/mpf/1.7.3/moyasar.css" />

    <!-- Moyasar Scripts -->
    <script src="https://polyfill.io/v3/polyfill.min.js?features=fetch"></script>
    <script src="https://cdn.moyasar.com/mpf/1.7.3/moyasar.js"></script>
@endsection

@section('content')



    <div class="mysr-form"></div>

    <script>
        Moyasar.init({
            element: '.mysr-form',
            // Amount in the smallest currency unit.
            // For example:
            // 10 SAR = 10 * 100 Halalas
            // 10 KWD = 10 * 1000 Fils
            // 10 JPY = 10 JPY (Japanese Yen does not have fractions)
            amount: "{{calculateOrderTotal()}}",
            currency: 'SAR',
            description: 'Order #{{lastOrderNumber()}}',
            publishable_api_key: 'pk_test_62dff6AEn6E44voUXJcCLbzvUYYq8JLQ4hShVoDJ',
            callback_url: '{{route('callback.payment')}}',
            {{--metadata: {--}}
            {{--    'order_id': '{{$order->id}}'--}}
            {{--},--}}
            methods: ['creditcard'],
            on_completed: function (payment) {
                axios.post('{{route('completed.payment')}}').then(function (response) {
                    console.log("response",response)
                })
            }
        })
    </script>
@endsection

