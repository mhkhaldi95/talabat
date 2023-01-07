@extends('layout.master')
@section('content')

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Card-->
            <div class="card">
                @include('validation.alerts')
                <!--begin::Form-->
                <form id="kt_docs_formvalidation_text" class="form p-4" method="post" action="{{isset($item)?route('branches.update',$item->id):route('branches.store')}}" autocomplete="off" >
                    @csrf
                    <div class="row">
                        <!--begin::Input group-->
                        <div class="col-6 mb-10">
                            <!--begin::Label-->
                            <label class=" fw-semibold fs-6 mb-2">{{__('lang.name')}}</label>
                            <!--end::Label-->

                            <!--begin::Input-->
                            <input type="text" name="name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="{{__('lang.name')}}" value="{{isset($item)?$item->user->name:''}}" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="col-6 mb-10">
                            <!--begin::Label-->
                            <label class=" fw-semibold fs-6 mb-2">{{__('lang.email')}}</label>
                            <!--end::Label-->

                            <!--begin::Input-->
                            <input type="email" name="email" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="{{__('lang.email')}}" value="{{isset($item)?$item->user->email:''}}" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                    </div>

                    <div class="row">
                        <!--begin::Input group-->
                        <div class="col-6 mb-10">
                            <!--begin::Label-->
                            <label class=" fw-semibold fs-6 mb-2">{{__('lang.password')}}</label>
                            <!--end::Label-->

                            <!--begin::Input-->
                            <input type="password" name="password" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="{{__('lang.password')}}" value="" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="col-6 mb-10">
                            <!--begin::Label-->
                            <label class="fw-semibold fs-6 mb-2">{{__('lang.password_confirmation')}}</label>
                            <!--end::Label-->

                            <!--begin::Input-->
                            <input type="password" name="password_confirmation" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="{{__('lang.password_confirmation')}}" value="" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                    </div>
                    <div class="row">
                        <!--begin::Input group-->
                        <div class="col-6 mb-10">
                            <!--begin::Label-->
                            <label class=" fw-semibold fs-6 mb-2">{{__('lang.address')}}</label>
                            <!--end::Label-->

                            <!--begin::Input-->
                            <textarea  name="address" class="form-control form-control-solid mb-3 mb-lg-0" rows="2" placeholder="{{__('lang.address')}}" >
                                {{isset($item)?$item->address:''}}
                            </textarea>
                            <!--end::Input-->
                        </div>
                        <!--begin::Input group-->
                        <div class="col-6 mb-10">
                            <!--begin::Label-->
                            <label class=" fw-semibold fs-6 mb-2">{{__('lang.phone')}}</label>
                            <!--end::Label-->

                            <!--begin::Input-->
                            <input type="text" name="phone" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="{{__('lang.phone')}}" value="{{isset($item)?$item->user->phone:''}}" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                    </div>
                    <div class="row">
                        <!--begin::Input group-->
                        <div class="col-6 mb-10">
                            <!--begin::Label-->
                            <label class=" fw-semibold fs-6 mb-2">{{__('lang.instagram_link')}}</label>
                            <!--end::Label-->

                            <!--begin::Input-->
                            <input type="text" name="instagram_link" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="{{__('lang.instagram_link')}}" value="{{isset($item)?$item->instagram_link:''}}" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="col-6 mb-10">
                            <!--begin::Label-->
                            <label class=" fw-semibold fs-6 mb-2">{{__('lang.twitter_link')}}</label>
                            <!--end::Label-->

                            <!--begin::Input-->
                            <input type="text" name="twitter_link" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="{{__('lang.twitter_link')}}" value="{{isset($item)?$item->twitter_link:''}}" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                    </div>
                    <div class="row">
                        <!--begin::Input group-->
                        <div class="col-6 mb-10">
                            <!--begin::Label-->
                            <label class=" fw-semibold fs-6 mb-2">{{__('lang.lat')}}</label>
                            <!--end::Label-->

                            <!--begin::Input-->
                            <input type="text" name="lat" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="{{__('lang.lat')}}" value="{{isset($item)?$item->lat:''}}" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="col-6 mb-10">
                            <!--begin::Label-->
                            <label class=" fw-semibold fs-6 mb-2">{{__('lang.lng')}}</label>
                            <!--end::Label-->

                            <!--begin::Input-->
                            <input type="text" name="lng" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="{{__('lang.lng')}}" value="{{isset($item)?$item->lng:''}}" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                    </div>
                    <div class="row">

                        <!--begin::Input group-->
                        <div class="col-6 mb-10">
                            <!--begin::Label-->
                            <label class=" fw-semibold fs-6 mb-2">{{__('lang.Status')}}</label>
                            <!--end::Label-->

                            <!--begin::Input-->
                            <select class="form-control" id="kt_select2_3" name="status" >
                                <option value="{{\App\Constants\Enum::BRANCH_CLOSED}}" {{isset($item)?\App\Constants\Enum::BRANCH_CLOSED == $item->status?'selected':'':''}} >{{__('lang.'.\App\Constants\Enum::BRANCH_CLOSED)}}</option>
                                <option value="{{\App\Constants\Enum::BRANCH_OPEN}}" {{isset($item)?\App\Constants\Enum::BRANCH_OPEN == $item->status?'selected':'':''}} >{{__('lang.'.\App\Constants\Enum::BRANCH_OPEN)}}</option>
                            </select>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                    </div>
                    <div id="map"></div>


                    <!--begin::Actions-->
                    <button id="kt_docs_formvalidation_text_submit1" type="submit" class="btn btn-primary">
                        <span class="indicator-label">
                           {{__('lang.submit')}}
                        </span>
                                        <span class="indicator-progress">
                            Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
@endsection
@section('scripts')
{{--    <script async defer--}}
{{--            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCiF79nNWttqCQcYcFYToE5XS1qJFbAUhY&callback=initMap">--}}
{{--    </script>--}}
    <script>
        // Class definition
        var KTSelect2 = function() {
            // Private functions
            var demos = function() {

                // multi select
                $('#kt_select2_3').select2({
                    placeholder: "Select a state",
                });
            }


            // Public functions
            return {
                init: function() {
                    demos();
                }
            };
        }();

        // Initialization
        jQuery(document).ready(function() {
            KTSelect2.init();
        });

        function initMap() {
            const myLatlng = { lat: -25.363, lng: 131.044 };
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 4,
                center: myLatlng,
            });
            console.log("map",map)
            // Create the initial InfoWindow.
            let infoWindow = new google.maps.InfoWindow({
                content: "Click the map to get Lat/Lng!",
                position: myLatlng,
            });

            infoWindow.open(map);
            // Configure the click listener.
            map.addListener("click", (mapsMouseEvent) => {
                // Close the current InfoWindow.
                infoWindow.close();
                // Create a new InfoWindow.
                infoWindow = new google.maps.InfoWindow({
                    position: mapsMouseEvent.latLng,
                });
                infoWindow.setContent(
                    JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)
                );
                infoWindow.open(map);
            });
        }

        // window.initMap = initMap;
    </script>
@endsection
