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
                <form id="kt_docs_formvalidation_text" class="form p-4" method="post" action="{{isset($item)?route('coupons.store',$item->id):route('coupons.store')}}" autocomplete="off" >
                    @csrf
                    <div class="row">
                        <!--begin::Input group-->
                        <div class="col mb-10">
                            <!--begin::Label-->
                            <label class=" fw-semibold fs-6 mb-2">{{__('lang.name')}}</label>
                            <!--end::Label-->

                            <!--begin::Input-->
                            <input type="text" name="name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="{{__('lang.name')}}" value="{{isset($item)?$item->name:''}}" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="col mb-10">
                            <!--begin::Label-->
                            <label class=" fw-semibold fs-6 mb-2">{{__('lang.code')}}</label>
                            <!--end::Label-->

                            <!--begin::Input-->
                            <input type="text" name="code" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="{{__('lang.code')}}" value="{{isset($item)?$item->code:''}}" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                    </div>
                    <div class="row">
                        <!--begin::Input group-->
                        <div class="col mb-10">
                            <!--begin::Label-->
                            <label class=" fw-semibold fs-6 mb-2">{{__('lang.discount')}}</label>
                            <!--end::Label-->

                            <!--begin::Input-->
                            <input type="number" name="discount" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="{{__('lang.discount')}}" value="{{isset($item)?$item->discount:''}}" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="col mb-10 form-group">
                            <label>{{__('lang.type')}}</label>
                            <div class="radio-inline mt-6" >
                                <label class="radio"  style="margin-left: 5%">
                                    <input type="radio" class="form-check-input" name="type" @if(isset($item) && $item->type == \App\Constants\Enum::FIXED)checked @endif value="{{\App\Constants\Enum::FIXED}}"/>
                                    <span></span>
                                    {{__('lang.'.\App\Constants\Enum::FIXED)}}
                                </label>
                                <label class="radio">
                                    <input type="radio" class="form-check-input" name="type" @if(isset($item) && $item->type == \App\Constants\Enum::PERCENTAGE)checked @endif  value="{{\App\Constants\Enum::PERCENTAGE}}" />
                                    <span></span>
                                    {{__('lang.'.\App\Constants\Enum::PERCENTAGE)}}
                                </label>

                            </div>

                        </div>
                        <!--end::Input group-->
                    </div>
                    <div class="row">
                        <!--begin::Input group-->
                        <div class="col mb-10">
                            <!--begin::Label-->
                            <label class=" fw-semibold fs-6 mb-2">{{__('lang.max_uses')}}</label>
                            <!--end::Label-->

                            <!--begin::Input-->
                            <input type="number" name="max_uses" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="{{__('lang.max_uses')}}" value="{{isset($item)?$item->max_uses:''}}" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="col mb-10">
                            <!--begin::Label-->
                            <label class=" fw-semibold fs-6 mb-2">{{__('lang.days')}}</label>
                            <!--end::Label-->

                            <!--begin::Input-->
                            <input type="number" name="days" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="{{__('lang.days')}}" value="{{isset($item)?$item->days:''}}" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                    </div>


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
    </script>
@endsection
