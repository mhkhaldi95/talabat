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
                <form id="kt_docs_formvalidation_text" class="form p-4" method="post" action="{{isset($item)?route('customers.store',$item->id):route('customers.store')}}" autocomplete="off" >
                    @csrf
                    <div class="row">
                        <!--begin::Input group-->
                        <div class="col-6 mb-10">
                            <!--begin::Label-->
                            <label class=" fw-semibold fs-6 mb-2">{{__('lang.name')}}</label>
                            <!--end::Label-->

                            <!--begin::Input-->
                            <input type="text" name="name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="{{__('lang.name')}}" value="{{isset($item)?$item->name:''}}" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="col-6 mb-10">
                            <!--begin::Label-->
                            <label class=" fw-semibold fs-6 mb-2">{{__('lang.email')}}</label>
                            <!--end::Label-->

                            <!--begin::Input-->
                            <input type="email" name="email" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="{{__('lang.email')}}" value="{{isset($item)?$item->email:''}}" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                    </div>
                    <div class="row">
                        <!--begin::Input group-->
                        <div class="col-6 mb-10">
                            <!--begin::Label-->
                            <label class=" fw-semibold fs-6 mb-2">{{__('lang.phone')}}</label>
                            <!--end::Label-->

                            <!--begin::Input-->
                            <input type="text" name="phone" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="{{__('lang.phone')}}" value="{{isset($item)?$item->phone:''}}" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="col-6 mb-10">
                            <!--begin::Label-->
                            <label class=" fw-semibold fs-6 mb-2">{{__('lang.gender')}}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <select class="form-select form-select-solid" data-control="select2" data-placeholder="Select an option" name="gender">
                                    <option value="{{\App\Constants\Enum::MALE}}" {{isset($item)?$item->gender == \App\Constants\Enum::MALE ?'selected':'':''}} >{{__('lang.male')}}</option>
                                    <option value="{{\App\Constants\Enum::FEMALE}}" {{isset($item)?$item->gender == \App\Constants\Enum::FEMALE ?'selected':'':''}} >{{__('lang.female')}}</option>
                            </select>
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
