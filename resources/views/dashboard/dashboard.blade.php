@extends('layout.master')
@section('content')


    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Content-->
            <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                <!--begin::Post-->
                <div class="post d-flex flex-column-fluid  card card-flush h-lg-100" id="kt_post">
                    <!--begin::Container-->
                    <div id="kt_content_container" class="container-xxl">
                        <!--begin::Main column-->
                            <div class="row">
                                <div class="col-md-4 col-lg-4 col-xl-4 ">
                                    <!--begin::Card widget 16-->
                                    <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-center" style="background-color: #080655;background-image:url('{{asset('assets/media/svg/shapes/wave-bg-dark.svg')}}')">
                                        <!--begin::Header-->
                                        <div class="card-header pt-5">
                                            <!--begin::Title-->
                                            <div class="card-title d-flex flex-column">
                                                <!--begin::Amount-->
                                                <span class="fs-2hx fw-bolder text-white me-2 lh-1 ls-n2">69</span>
                                                <!--end::Amount-->
                                                <!--begin::Subtitle-->
                                                <span class="text-white opacity-50 pt-1 fw-bold fs-6">Active Projects</span>
                                                <!--end::Subtitle-->
                                            </div>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Header-->
                                        <!--begin::Card body-->
                                        <div class="card-body d-flex align-items-end pt-0">
                                            <!--begin::Progress-->
                                            <div class="d-flex align-items-center flex-column mt-3 w-100">
                                                <div class="d-flex justify-content-between fw-bolder fs-6 text-white opacity-50 w-100 mt-auto mb-2">
                                                    <span>43 Pending</span>
                                                    <span>72%</span>
                                                </div>
                                                <div class="h-8px mx-3 w-100 bg-light-danger rounded">
                                                    <div class="bg-danger rounded h-8px" role="progressbar" style="width: 72%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <!--end::Progress-->
                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                    <!--end::Card widget 16-->

                                </div>

                            </div>

                        <!--end::Main column-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Post-->
            </div>
            <!--end::Content-->

        </div>
    </div>
@endsection
