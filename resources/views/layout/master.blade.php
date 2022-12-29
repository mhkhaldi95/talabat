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
                        @yield('content')
                    <!--end::Container-->
                </div>
                <!--end::Toolbar-->
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
<script src="{{asset('')}}assets/plugins/custom/datatables/datatables.bundle.js"></script>
{{--<script src="{{asset('')}}assets/js/custom/documentation/general/datatables/server-side.js"></script>--}}

<!--end::Page Custom Javascript-->
<!--end::Javascript-->
@yield('scripts')
</body>
<!--end::Body-->
</html>
