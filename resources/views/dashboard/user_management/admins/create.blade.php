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
                <form id="kt_docs_formvalidation_text" class="form p-4" method="post" action="{{isset($item)?route('admins.update',$item->id):route('admins.store')}}" autocomplete="off" >
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
                            <label class=" fw-semibold fs-6 mb-2">{{__('lang.roles')}}</label>
                            <!--end::Label-->

                            <!--begin::Input-->
                            <select class="form-control select2" id="kt_select2_3" name="roles[]" multiple="multiple">
                                @foreach($roles as $role)
                                    <option value="{{$role->id}}"{{isset($item)?in_array($role->id,$role_user)?'selected':'':''}} >{{$role->name}}</option>
                                @endforeach
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
{{--@section('scripts')--}}
{{--    <script>--}}
{{--        // Define form element--}}
{{--        const form = document.getElementById('kt_docs_formvalidation_text1');--}}

{{--        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/--}}
{{--        var validator = FormValidation.formValidation(--}}
{{--            form,--}}
{{--            {--}}
{{--                fields: {--}}
{{--                    'name': {--}}
{{--                        validators: {--}}
{{--                            notEmpty: {--}}
{{--                                message: 'required'--}}
{{--                            }--}}
{{--                        }--}}
{{--                    },--}}
{{--                    'email': {--}}
{{--                        validators: {--}}
{{--                            notEmpty: {--}}
{{--                                message: 'required'--}}
{{--                            }--}}
{{--                        }--}}
{{--                    },--}}
{{--                },--}}

{{--                plugins: {--}}
{{--                    trigger: new FormValidation.plugins.Trigger(),--}}
{{--                    bootstrap: new FormValidation.plugins.Bootstrap5({--}}
{{--                        rowSelector: '.fv-row',--}}
{{--                        eleInvalidClass: '',--}}
{{--                        eleValidClass: ''--}}
{{--                    })--}}
{{--                }--}}
{{--            }--}}
{{--        );--}}

{{--        // Submit button handler--}}
{{--        const submitButton = document.getElementById('kt_docs_formvalidation_text_submit');--}}
{{--        submitButton.addEventListener('click', function (e) {--}}
{{--            // Prevent default button action--}}
{{--            e.preventDefault();--}}

{{--            // Validate form before submit--}}
{{--            if (validator) {--}}
{{--                validator.validate().then(function (status) {--}}
{{--                    console.log('validated!');--}}

{{--                    if (status == 'Valid') {--}}
{{--                        // Show loading indication--}}
{{--                        submitButton.setAttribute('data-kt-indicator', 'on');--}}

{{--                        // Disable button to avoid multiple click--}}
{{--                        submitButton.disabled = true;--}}

{{--                        // Simulate form submission. For more info check the plugin's official documentation: https://sweetalert2.github.io/--}}
{{--                        setTimeout(function () {--}}
{{--                            // Remove loading indication--}}
{{--                            submitButton.removeAttribute('data-kt-indicator');--}}

{{--                            // Enable button--}}
{{--                            submitButton.disabled = false;--}}

{{--                            // Show popup confirmation--}}
{{--                            // Swal.fire({--}}
{{--                            //     text: "Form has been successfully submitted!",--}}
{{--                            //     icon: "success",--}}
{{--                            //     buttonsStyling: false,--}}
{{--                            //     confirmButtonText: "Ok, got it!",--}}
{{--                            //     customClass: {--}}
{{--                            //         confirmButton: "btn btn-primary"--}}
{{--                            //     }--}}
{{--                            // });--}}

{{--                            form.submit(); // Submit form--}}
{{--                        }, 2000);--}}
{{--                    }--}}
{{--                });--}}
{{--            }--}}
{{--        });--}}
{{--    </script>--}}
{{--@endsection--}}
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
