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
                <form id="kt_docs_formvalidation_text" class="form p-4" method="post" action="{{isset($item)?route('addons.store',$item->id):route('addons.store')}}" autocomplete="off" >
                    @csrf
                    <div class="row">
                        <!--begin::Input group-->
                        <div class="col mb-10">
                            <!--begin::Label-->
                            <label class=" fw-semibold fs-6 mb-2">{{__('lang.name_ar')}}</label>
                            <!--end::Label-->

                            <!--begin::Input-->
                            <input type="text" name="name_ar" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="{{__('lang.name_ar')}}" value="{{isset($item)?$item->name:''}}" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="col mb-10">
                            <!--begin::Label-->
                            <label class=" fw-semibold fs-6 mb-2">{{__('lang.name_en')}}</label>
                            <!--end::Label-->

                            <!--begin::Input-->
                            <input type="text" name="name_en" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="{{__('lang.name_en')}}" value="{{isset($item)?$item->name:''}}" />
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

