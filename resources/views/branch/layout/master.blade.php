<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: Metronic - Bootstrap 5 HTML, VueJS, React, Angular & Laravel Admin Dashboard Theme
Purchase: https://1.envato.market/EA4JP
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
{{--<html lang="en">--}}
<html lang="{{app()->getLocale() == 'ar'?'ar':'en'}}" dir="{{app()->getLocale() == 'ar'?'rtl':'ltr'}}">
<!--begin::Head-->
<head><base href="">
    @include('layout.head')
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
<!--begin::Main-->
<!--begin::Root-->
<div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="page d-flex flex-row flex-column-fluid">
        <!--begin::Aside-->
        @include('layout.aside')
        <!--end::Aside-->
        <!--begin::Wrapper-->
        <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
            <!--begin::Header-->
           @include('layout.header')
            <!--end::Header-->
            <!--begin::Content-->
            <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                <!--begin::Toolbar-->
                <div class="toolbar" id="kt_toolbar">
                    <!--begin::Container-->
                    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                        <!--begin::Page title-->
                        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                            <!--begin::Title-->
                            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">{{$page_title}}</h1>
                            <!--end::Title-->
                            <!--begin::Separator-->
                            <span class="h-20px border-gray-200 border-start mx-4"></span>
                            <!--end::Separator-->
                            <!--begin::Breadcrumb-->
                            @include('layout.breadcrumb')
                            <!--end::Breadcrumb-->
                        </div>
                        <!--end::Page title-->

                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Toolbar-->
               @yield('content')
            </div>
            <!--end::Content-->
            <!--begin::Footer-->
           @include('layout.footer')
            <!--end::Footer-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>
<!--end::Root-->

<!--begin::Javascript-->
<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="{{asset('')}}assets/plugins/global/plugins.bundle.js"></script>
<script src="{{asset('')}}assets/js/scripts.bundle.js"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Page Vendors Javascript(used by this page)-->
<script src="{{asset('')}}assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
<!--end::Page Vendors Javascript-->
<!--begin::Page Custom Javascript(used by this page)-->
<script src="{{asset('')}}assets/js/custom/widgets.js"></script>
<script src="{{asset('')}}assets/js/custom/apps/chat/chat.js"></script>
<script src="{{asset('')}}assets/js/custom/modals/create-app.js"></script>
<script src="{{asset('')}}assets/js/custom/modals/upgrade-plan.js"></script>
<!--begin::Page Vendors Javascript(used by this page)-->
<script src="{{asset('')}}assets/plugins/custom/datatables/datatables.bundle.js"></script>
<!--end::Page Vendors Javascript-->
{{--<script src="{{asset('')}}assets/js/custom/documentation/general/datatables/server-side.js"></script>--}}
<script src="{{asset('')}}assets/js/custom/documentation/general/toastr.js"></script>
{{--<script src="{{asset('')}}assets/js/custom/bootstrap-datepicker.js"></script>--}}
<!--end::Page Custom Javascript-->
<!--end::Javascript-->
@yield('scripts')

<script type="text/javascript">

    @if(Session::has('message'))
        toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        @if(app()->getLocale() == 'ar')
        "positionClass": "toast-top-left",
        @else
        "positionClass": "toast-top-right",
        @endif
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    var type = "{{Session::get('alert-type','info')}}"
    switch (type) {
        case 'info':
            toastr.info("{{Session::get('message') }}");
            break;
        case 'success':
            toastr.success("{{Session::get('message') }}");
            break;
        case 'warning':
            toastr.warning("{{Session::get('message') }}");
            break;
        case 'error':
            toastr.error("{{Session::get('message') }}");
            break;
    }
    @endif
</script>
</body>
<!--end::Body-->
</html>
