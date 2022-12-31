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
                <form id="kt_docs_formvalidation_text" class="form p-4" method="post" action="{{isset($item)?route('roles.update',$item->id):route('roles.store')}}" autocomplete="off" >
                    @csrf
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_update_role_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_update_role_header" data-kt-scroll-wrappers="#kt_modal_update_role_scroll" data-kt-scroll-offset="300px">
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="fs-5 fw-bolder form-label mb-2">
                                <span class="required">{{__('lang.name')}}</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
{{--                            <input class="form-control form-control-solid" placeholder="{{__('lang.name')}}" name="name"  />--}}
                            <input type="text" name="name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="{{__('lang.name')}}" value="{{isset($item)?$item->name:''}}" />

                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Permissions-->
                        <div class="fv-row">
                            <!--begin::Label-->
                            <label class="fs-5 fw-bolder form-label mb-2">{{__('lang.Role Permissions')}}</label>
                            <!--end::Label-->
                            <!--begin::Table wrapper-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-dashed fs-6 gy-5">
                                    <!--begin::Table body-->
                                    <tbody class="text-gray-600 fw-bold">
                                    <!--begin::Table row-->
                                    <tr>
                                        <td class="text-gray-800">
                                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Allows a full access to the system"></i></td>
                                        <td>
                                            <!--begin::Checkbox-->
                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-9">
                                                <input class="form-check-input all-check" type="checkbox"  />
                                                <span class="form-check-label" for="kt_roles_select_all">{{__('lang.Select all')}}</span>
                                            </label>
                                            <!--end::Checkbox-->
                                        </td>
                                    </tr>
                                    <!--end::Table row-->
                                    @foreach($permissions as $index => $per)
                                    <!--begin::Table row-->
                                    <tr>
                                        <!--begin::Label-->
                                        <td class="text-gray-800">{{$per}} Management</td>
                                        <!--end::Label-->
                                        <!--begin::Input group-->
                                        <td>
                                            <!--begin::Wrapper-->
                                            <div class="d-flex">
                                                <!--begin::Checkbox-->
                                                <label class="form-check form-check-custom form-check-solid me-5 me-lg-20">
                                                    <input type="checkbox" class="form-check-input" value="{{$index+1}}" {{in_array($index+1,$permission_role)?'checked':''}} name="permissions[]">
                                                    <span class="form-check-label">Create</span>
                                                </label>
                                                <!--end::Checkbox-->
                                                <!--begin::Checkbox-->
                                                <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                    <input type="checkbox" class="form-check-input" value="{{$index+2}}" {{in_array($index+2,$permission_role)?'checked':''}} name="permissions[]">
                                                    <span class="form-check-label">Read</span>
                                                </label>
                                                <!--end::Checkbox-->
                                                <!--begin::Checkbox-->
                                                <label class="form-check form-check-custom form-check-solid me-5 me-lg-20">
                                                    <input type="checkbox" class="form-check-input" value="{{$index+3}}" {{in_array($index+3,$permission_role)?'checked':''}} name="permissions[]">
                                                    <span class="form-check-label">Update</span>
                                                </label>
                                                <!--end::Checkbox-->
                                                <!--begin::Checkbox-->
                                                <label class="form-check form-check-custom form-check-solid">
                                                    <input type="checkbox" class="form-check-input" value="{{$index+4}}" {{in_array($index+4,$permission_role)?'checked':''}} name="permissions[]">
                                                    <span class="form-check-label">Delete</span>
                                                </label>
                                                <!--end::Checkbox-->
                                            </div>
                                            <!--end::Wrapper-->
                                        </td>
                                        <!--end::Input group-->
                                    </tr>
                                    <!--end::Table row-->
                                    @endforeach
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Table wrapper-->
                        </div>
                        <!--end::Permissions-->
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="submit" class="btn btn-primary" >
                           {{__('lang.submit')}}
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
@endsection


@section('scripts')
    <script>
        $('.all-check:checkbox').change(function() {
            // this will contain a reference to the checkbox
            if (this.checked) {
                $("[type='checkbox']").each(function( index ) {
                    $(this).prop('checked', true);;
                });
            } else {
                $("[type='checkbox']").each(function( index ) {
                    $(this).prop('checked', false);;
                });
            }
        });
        $('.select-row:checkbox').change(function() {
            // this will contain a reference to the checkbox
            if (this.checked) {

                $(this).closest('tr').find("[type='checkbox']").each(function( index ) {
                    $(this).prop('checked', true);
                });
            } else {
                $(this).closest('tr').find("[type='checkbox']").each(function( index ) {
                    $(this).prop('checked', false);
                });
            }
        });
    </script>
@endsection
