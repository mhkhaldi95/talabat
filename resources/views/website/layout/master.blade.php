<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{$settings->site_name}} | {{isset($page_title)?$page_title:'بريك'}}</title>
    <meta name="description" content="{{$settings->site_description}}" />
    <meta name="keywords" content="{{$settings->tags}}" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="{{asset('')}}assets/website/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('')}}assets/website/css/all.min.css">
    <link rel="stylesheet" href="{{asset('')}}assets/website/css/index.css">
    <link rel="stylesheet" href="{{asset('')}}assets/website/css/custom.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" />
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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

<!-- the Section Start model -->
<div class="modal fade" id="modal-mobile-login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close right " data-bs-dismiss="modal" aria-label="Close"></button>
                <h4 class="modal-title text-right" id="staticBackdropLabel">التحقق من رقم الجوال</h4>
            </div>
            <div class="modal-body d-flex justify-content-center flex-row sizes">
                <form>
                    <div class="input-group flex-nowrap mobile">
                        <input type="text" class="form-control py-2 rr tele" placeholder="Username" id="modal-mobile-input" aria-label="Username" aria-describedby="addon-wrapping">
                        <span class="input-group-text rud" id="addon-wrapping">+966 <img src="{{asset('')}}assets/website/img/saudi-arabia.png" alt="" width="28px;" class="pe-2 left"></span>

                    </div>
                    <div style="padding-right: 9%" id="mobile_hide"  class="selector_hide">
                        <span class="text-danger hide "> يجب ادخال رقم الجوال</span>
                    </div>

                </form>
            </div>
            <div class="modal-footer button-next">
                <button class="box-button fs-5" id="modal-mobile-login-next">
                    التالي
                </button>
            </div>
        </div>
    </div>
</div>
<!-- the Section End model -->
<script src="{{asset('')}}assets/website/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('')}}assets/website/js/all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

@yield('script')
@include('website.layout.script')
</body>
</html>
