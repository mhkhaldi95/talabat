<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Break</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="{{asset('')}}assets/website/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('')}}assets/website/css/all.min.css">
    <link rel="stylesheet" href="{{asset('')}}assets/website/css/index.css">
    <link rel="stylesheet" href="{{asset('')}}assets/website/css/custom.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" />
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    @yield('style')
</head>
<body>
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


<script src="{{asset('')}}assets/website/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('')}}assets/website/js/all.min.js"></script>
@yield('script')

</body>
</html>
