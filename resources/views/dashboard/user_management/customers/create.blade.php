@extends('layout.master')
@section('content')

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Card-->


            <div class="card">
                <!--begin:::Tabs-->
                <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 form p-4 fw-bold mb-n2">
                    <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                           href="#kt_ecommerce_add_product_general">{{__('customer_info')}}</a>
                    </li>
                    <!--end:::Tab item-->
                    <li class="nav-item"> <a class="nav-link text-active-primary pb-4 "
                                            >|</a></li>
                    <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                           href="#kt_ecommerce_add_product_reviews">{{__('lang.orders')}}</a>
                    </li>
                    <!--end:::Tab item-->
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general"
                         role="tab-panel">
                        <!--end:::Tabs-->
                        @include('validation.alerts')
                        <!--begin::Form-->
                        <form id="kt_docs_formvalidation_text" class="form p-4" method="post"
                              action="{{isset($item)?route('customers.store',$item->id):route('customers.store')}}"
                              autocomplete="off">
                            @csrf
                            @if(isset($item))
                                <div class="alert alert-warning">
                                    {{__('Cashback balance')}} {{auth()->user()->balance}} {{__('productPrice')}}
                                </div>
                            @endif
                            <div class="row">
                                <!--begin::Input group-->
                                <div class="col-6 mb-10">
                                    <!--begin::Label-->
                                    <label class=" fw-semibold fs-6 mb-2">{{__('lang.name')}}</label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <input type="text" name="name" class="form-control form-control-solid mb-3 mb-lg-0"
                                           placeholder="{{__('lang.name')}}" value="{{isset($item)?$item->name:''}}"/>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="col-6 mb-10">
                                    <!--begin::Label-->
                                    <label class=" fw-semibold fs-6 mb-2">{{__('lang.email')}}</label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <input type="email" name="email" class="form-control form-control-solid mb-3 mb-lg-0"
                                           placeholder="{{__('lang.email')}}" value="{{isset($item)?$item->email:''}}"/>
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
                                    <input type="text" name="phone" class="form-control form-control-solid mb-3 mb-lg-0"
                                           placeholder="{{__('lang.phone')}}" value="{{isset($item)?$item->phone:''}}"/>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="col-6 mb-10">
                                    <!--begin::Label-->
                                    <label class=" fw-semibold fs-6 mb-2">{{__('lang.gender')}}</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <select class="form-select form-select-solid" data-control="select2"
                                            data-placeholder="Select an option" name="gender">
                                        <option
                                            value="{{\App\Constants\Enum::MALE}}" {{isset($item)?$item->gender == \App\Constants\Enum::MALE ?'selected':'':''}} >{{__('lang.male')}}</option>
                                        <option
                                            value="{{\App\Constants\Enum::FEMALE}}" {{isset($item)?$item->gender == \App\Constants\Enum::FEMALE ?'selected':'':''}} >{{__('lang.female')}}</option>
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
                    <div class="tab-pane fade show form p-4"  id="kt_ecommerce_add_product_reviews"
                         role="tab-panel">
                        <!--begin::Table container-->
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table align-middle table-row-dashed fs-6 gy-5"  id="datatable">
                                <!--begin::Table head-->
                                <thead>
                                <!--begin::Table row-->
                                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                    <th class="min-w-125px ">
                                        #
                                    </th>
                                    <th class="min-w-125px">{{__('lang.branch')}}</th>
                                    <th class="min-w-125px">{{__('lang.user')}}</th>
                                    <th class="min-w-125px">{{__('lang.price')}}</th>
                                    <th class="min-w-125px">{{__('lang.date')}}</th>
                                    <th class="min-w-125px">{{__('lang.status')}}</th>
                                    <th class="min-w-125px">{{__('lang.actions')}}</th>
                                </tr>
                                <!--end::Table row-->
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="fw-bold text-gray-600">
                                @foreach(\App\Http\Resources\Orders\OrderResource::collection($item->orders)->resolve() as $order)
                                    <tr>
                                        <td>{{$order['id']}}</td>
                                        <td>{{$order['branch']}}</td>
                                        <td>{{$order['user']}}</td>
                                        <td>{{$order['price']}}</td>
                                        <td>{{$order['created_at']}}</td>
                                        <td>{!! $order['status'] !!}</td>
                                        <td>{!! $order['actions'] !!}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <!--end::Table body-->
                            </table>
                        </div>
                        <!--end::Table-->
                    </div>
                </div>

            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
@endsection
@section('scripts')
    <script>
        $("#datatable").DataTable({});
    </script>
@endsection
