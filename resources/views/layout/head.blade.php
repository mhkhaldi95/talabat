
<title>{{$settings->site_name}} | {{isset($page_title)?$page_title:'بريك'}}</title>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta charset="utf-8" />
<link rel="shortcut icon" href="{{$settings->icon}}" />
<meta name="csrf-token" content="{{ csrf_token() }}">

<!--begin::Fonts-->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
<!--end::Fonts-->
<link href="{{asset('')}}assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
<!--begin::Page Vendor Stylesheets(used by this page)-->
<link href="{{asset('')}}assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<!--end::Page Vendor Stylesheets-->
@if(app()->getLocale() == 'ar')
    <!--begin::Page Vendor Stylesheets(used by this page)-->
    <link href="{{asset('')}}assets/plugins/custom/fullcalendar/fullcalendar.bundle.rtl.css" rel="stylesheet" type="text/css" />
    <!--end::Page Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{asset('')}}assets/plugins/global/plugins.bundle.rtl.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('')}}assets/css/style.bundle.rtl.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('')}}assets/css/custom.rtl.css" rel="stylesheet" type="text/css" />

    <!--end::Global Stylesheets Bundle-->
@else

    <!--begin::Page Vendor Stylesheets(used by this page)-->
    <link href="{{asset('')}}assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Page Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{asset('')}}assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('')}}assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
@endif
<link href="{{asset('')}}assets/css/custom.css" rel="stylesheet" type="text/css" />

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="{{ asset('js/app.js') }}" defer></script>

@yield('head')
