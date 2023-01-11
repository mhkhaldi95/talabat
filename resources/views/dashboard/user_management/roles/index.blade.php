@extends('layout.master')
@section('content')
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Row-->
            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-5 g-xl-9">
                @foreach($roles as $role)
                    <!--begin::Col-->
                    <div class="col-md-4">
                        <!--begin::Card-->
                        <div class="card card-flush h-md-100">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2>{{$role->name}}</h2>
                                </div>
                                <!--end::Card title-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-1">
                                <!--begin::Users-->
{{--                                <div class="fw-bolder text-gray-600 mb-5">{{__('lang.Total users with this role:')}} {{$role->user_count}}</div>--}}
                                <!--end::Users-->
                                <!--begin::Permissions-->
                                <div class="d-flex flex-column text-gray-600">
                                    @foreach($role->permissions()->take(5)->get() as $permission)
                                        <div class="d-flex align-items-center py-2">
                                            <span class="bullet bg-primary me-3"></span>{{$permission->display_name}}
                                        </div>
                                    @endforeach
                                     @if($role->permissions()->count() > 0)
                                        <div class='d-flex align-items-center py-2'>
                                            <span class='bullet bg-primary me-3'></span>
                                            <em>{{__('lang.and')}} {{$role->permissions()->count() - 5}} {{__('lang.more')}}...</em>
                                        </div>
                                    @endif
                                </div>
                                <!--end::Permissions-->
                            </div>
                            <!--end::Card body-->
                            <!--begin::Card footer-->
                            <div class="card-footer flex-wrap pt-0">
                                <a href="{{route('roles.create',$role->id)}}" class="btn btn-light btn-active-light-primary my-1"  >{{__('lang.edit')}}</a>
                                <a href="javascript:void(0);" data-id="{{$role->id}}" data-name="{{$role->display_name}}" class="btn btn-danger btn-active-danger-primary my-1 delete_role"   >{{__('lang.delete')}}</a>
                            </div>
                            <!--end::Card footer-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Col-->
                @endforeach
                    <!--begin::Add new card-->
                    <div class="col-md-4">
                        <!--begin::Card-->
                        <div class="card h-md-100">
                            <!--begin::Card body-->
                            <div class="card-body d-flex flex-center">
                                <!--begin::Button-->
                                <a href="{{route('roles.create')}}" class="btn btn-clear d-flex flex-column flex-center" >
                                    <!--begin::Illustration-->
                                    <img src="{{asset('')}}assets/media/illustrations/sketchy-1/4.png" alt="" class="mw-100 mh-150px mb-7" />
                                    <!--end::Illustration-->
                                    <!--begin::Label-->
                                    <div class="fw-bolder fs-3 text-gray-600 text-hover-primary">{{__('lang.Add New Role')}}</div>
                                    <!--end::Label-->
                                </a>
                                <!--begin::Button-->
                            </div>
                            <!--begin::Card body-->
                        </div>
                        <!--begin::Card-->
                    </div>
                    <!--begin::Add new card-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            //set initial state.
            $('.delete_role').on( "click", function() {
                const delete_role = $(this);
                const RoleName = $(this).data('name')
                Swal.fire({
                    text: "{{__('lang.Are you sure you want to delete')}} " + RoleName + "?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, delete!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function (result) {
                    if (result.value) {
                        // Simulate delete request -- for demo purpose only
                        Swal.fire({
                            text: "Deleting " + RoleName,
                            icon: "info",
                            buttonsStyling: false,
                            showConfirmButton: false,
                            timer: 2000
                        }).then(function () {
                            Swal.fire({
                                text: "You have deleted " + RoleName + "!.",
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary",
                                }
                            }).then(function () {
                                const id = delete_role.data('id')
                                // delete row data from server and re-draw datatable
                                axios.post('/admin/roles/delete',{'id':id}).then(function (response) {
                                    location.reload();
                                })

                            });
                        });
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: RoleName + " was not deleted.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary",
                            }
                        });
                    }
                });


            });
        });
    </script>
@endsection