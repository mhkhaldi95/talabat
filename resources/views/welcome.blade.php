<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Moyasar Styles -->
        <link rel="stylesheet" href="https://cdn.moyasar.com/mpf/1.7.3/moyasar.css" />

        <!-- Moyasar Scripts -->
        <script src="https://polyfill.io/v3/polyfill.min.js?features=fetch"></script>
        <script src="https://cdn.moyasar.com/mpf/1.7.3/moyasar.js"></script>
    </head>
    <body class="antialiased">
    <div class="mysr-form"></div>
    <script>
    Moyasar.init({
    element: '.mysr-form',
    // Amount in the smallest currency unit.
    // For example:
    // 10 SAR = 10 * 100 Halalas
    // 10 KWD = 10 * 1000 Fils
    // 10 JPY = 10 JPY (Japanese Yen does not have fractions)
    amount: 1000,
    currency: 'SAR',
    description: 'Coffee Order #1',
    publishable_api_key: 'pk_test_62dff6AEn6E44voUXJcCLbzvUYYq8JLQ4hShVoDJ',
    callback_url: 'https://moyasar.com/thanks',
    methods: ['creditcard'],
        on_completed: function (payment) {
            toastr.success("تم الدفع بنجاح");
            return;
            {{--axios.post('{{route('test-payment')}}').then(response => {--}}
            {{--    toastr.success("تم الدفع بنجاح");--}}
            {{--    setTimeout(function (){--}}
            {{--        window.location.reload()--}}
            {{--    }, 1500)--}}
            {{--}).catch(error => {--}}
            {{--    toastr.success("Login Failed");--}}
            {{--});--}}
        },
    })
    </script>
    </body>

</html>
