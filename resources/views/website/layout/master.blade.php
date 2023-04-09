@php
    app()->setLocale(session('locale','ar'));
@endphp
<!DOCTYPE html>
@if(app()->getLocale() == 'ar')
    <html lang="ar" dir="rtl">
    @else
        <html lang="en" dir="ltr">
        @endif
        <head>
            <!-- Required meta tags -->
            <meta charset="utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1" />
            <!-- ../Required meta tags -->
            <meta name="csrf-token" content="{{ csrf_token() }}">

            <title>{{$settings->site_name}} | {{isset($page_title)?$page_title:'بريك'}}</title>
            <meta name="description" content="{{$settings->site_description}}" />
            <meta name="keywords" content="{{$settings->tags}}" />
            <meta property="og:locale" content="{{app()->getLocale()}}" />
            <meta property="og:type" content="article" />
            <meta property="og:title" content="{{isset($page_title)?$page_title:'بريك'}}" />
            <meta property="og:url" content="{{isset($page_url)?$page_url:route('break.index')}}" />
            <meta property="og:site_name" content="{{$settings->site_name}}" />
            <meta name="twitter:description" content="{{$settings->site_description}}" />
            <meta name="twitter:title" content="{{isset($page_url)?$page_url:route('break.index')}}" />
            <meta name="twitter:url" content="{{isset($page_url)?$page_url:route('break.index')}}" />
            <meta name="twitter:image" content="{{$settings->icon}}" />
            <link rel="canonical" href="{{isset($page_url)?$page_url:route('break.index')}}" />
            <link rel="shortcut icon" href="{{$settings->icon}}" />
            <!-- Bootstrap CSS -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
                  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
            <!--../ Bootstrap CSS -->

            <!-- font  Poppins-->
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500&display=swap" rel="stylesheet">
            <!-- ../font  Poppins-->

            <!-- font tajawal -->
            <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;600&family=Tajawal:wght@700&display=swap"
                  rel="stylesheet">
            <!--../font tajawal -->

            <!-- font awesome-->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
                  integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
                  crossorigin="anonymous" referrerpolicy="no-referrer" />
            <!-- ../font awesome-->

            <!-- --------css styles -------->
            <!-- wow libaray css -->
            <link rel="stylesheet" href="{{asset('')}}assets/website/css/animate.css">
            <!-- owl.carousel libaray css -->
            <link rel="stylesheet" href="{{asset('')}}assets/website/css/owl.carousel.min.css" />
            <link rel="stylesheet" href="{{asset('')}}assets/website/css/owl.theme.default.css" />

            <!-- custom css -->
            <link rel="stylesheet" href="{{asset('')}}assets/website/css/style.css" />
            <link rel="stylesheet" href="{{asset('')}}assets/website/css/custom.css" />
            <!-- --------../css styles ------ -->
            <link rel="stylesheet" href="https://cdn.tutorialjinni.com/intl-tel-input/17.0.8/css/intlTelInput.css" />
            <script src="https://cdn.tutorialjinni.com/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
            <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
            <script src="{{ asset('js/app.js') }}" defer></script>

            @yield('head')
        </head>
<body  @if(app()->getLocale() == 'ar')
           style="text-align: right; font-family: Tajawal;"
       @else
           style="text-align: left; font-family: Poppins;"
    @endif >
<!-- the Section Start NavBar -->
@include('website.layout.header')
<!-- the Section End NavBar -->

<!-- the Section Start definition -->
@include('website.layout.breadcrumb')
<!-- the Section End  definition -->


<!-- the Section Categories start -->
@yield('content')
<!-- the Section Categories End -->



<!-- the Section Start Footer-->
@include('website.layout.footer')
<!-- the Section End Footer -->

<!-- the Section Start model -->



{{--<audio controls id="audio" class="">--}}
{{--    <source src="https://server6.mp3quran.net/thubti/001.mp3" type="audio/mpeg">--}}
{{--</audio>--}}

<!-- the Section End model -->



<!-- bootstrap js cdns -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

<!-- jquery js cdns -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- owl.carousel js scripts -->
<script src="{{asset('')}}assets/website/js/owl.carousel.min.js"></script>
<script src="{{asset('')}}assets/website/js/wow.min.js"></script>
<script src="{{asset('')}}assets/website/js/index.js"></script>

<!-- WOW init -->
<script>
    new WOW().init();
</script>

<!--custom js  -->
<script src="{{asset('')}}assets/website/js/main.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@yield('script')
@include('website.layout.script')
</body>
</html>
