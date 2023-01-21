@extends('branch.layout.master')
@section('content')
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Form-->
            <form id="kt_ecommerce_add_product_form">

            </form>

            <form action="#" method="post" class="form d-flex flex-column flex-lg-row" enctype="multipart/form-data">
                @csrf
                <!--begin::Aside column-->
                <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                    <!--begin::Thumbnail settings-->
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>{{__('lang.Thumbnail')}}</h2>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body text-center pt-0">

                            <!--begin::Image input-->

                            <div class="image-input image-input-empty image-input-outline mb-3" id="avatar" data-kt-image-input="true"
                                 style="background-image: url({{isset($item)?$item['master_photo']:asset('assets/media/default.png')}})">
                                <!--begin::Preview existing avatar-->
                                <div class="image-input-wrapper w-150px h-150px"></div>
                                <!--end::Preview existing avatar-->
                                <!--begin::Label-->
                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                    <i class="bi bi-pencil-fill fs-7"></i>
                                    <!--begin::Inputs-->
                                    <input type="file" disabled name="master_photo" accept=".png, .jpg, .jpeg" />
                                    <input type="hidden" disabled name="avatar_remove" />
                                    <!--end::Inputs-->
                                </label>
                                <!--end::Label-->
                                <!--begin::Cancel-->
                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
														<i class="bi bi-x fs-2"></i>
													</span>
                                <!--end::Cancel-->
                                <!--begin::Remove-->
                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
														<i class="bi bi-x fs-2"></i>
													</span>
                                <!--end::Remove-->
                            </div>
                            <!--end::Image input-->
                            <!--begin::Description-->
{{--                            <div class="text-muted fs-7">Set the product thumbnail image. Only *.png, *.jpg and *.jpeg image files are accepted</div>--}}
                            <!--end::Description-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Thumbnail settings-->
                    <!--begin::Status-->
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>{{__('lang.Status')}} ({{__('lang.admin')}})</h2>
                            </div>
                            <!--end::Card title-->
                            <!--begin::Card toolbar-->
                            <div class="card-toolbar">
                                <div class="rounded-circle bg-success w-15px h-15px" id="kt_ecommerce_add_product_status"></div>
                            </div>
                            <!--begin::Card toolbar-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Select2-->
                            <select class="form-select mb-2" disabled  data-control="select2" data-hide-search="true"  name="status" data-placeholder="{{__('lang.Select an option')}}" id="kt_ecommerce_add_product_status_select">
                                <option></option>
                                <option value="{{\App\Constants\Enum::PUBLISHED}}" {{isset($item)?$item['status'] == \App\Constants\Enum::PUBLISHED?'selected':'':''}}>{{__('lang.Published')}}</option>
                                <option value="{{\App\Constants\Enum::INACTIVE}}" {{isset($item)?$item['status'] == \App\Constants\Enum::INACTIVE?'selected':'':''}}>{{__('lang.Inactive')}}</option>
                            </select>
                            <!--end::Datepicker-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Status-->
                    <!--begin::Category & tags-->
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>{{__('lang.Product Details')}}</h2>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Input group-->
                            <!--begin::Label-->
                            <label class="form-label">{{__('lang.Categories')}}</label>
                            <!--end::Label-->
                            <!--begin::Select2-->

                            <select class="form-select mb-2" disabled data-control="select2" name="category_id" data-placeholder="{{__('lang.Select an option')}}" data-allow-clear="true" >
{{--                                multiple="multiple"--}}
                                <option></option>
                                @foreach($categories as $category)
                                 <option value="{{$category->id}}" {{isset($item)?($item['category_id'] == $category->id ? 'selected' : ''):''}}>{{$category->name}}</option>
                                @endforeach
                            </select>
                            <!--end::Select2-->
                            <!--begin::Description-->
{{--                            <div class="text-muted fs-7 mb-7">{{__('lang.Add product to a category.')}}</div>--}}
                            <!--end::Description-->
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <!--begin::Label-->
                            <label class="form-label d-block">{{__('lang.Tags')}}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input disabled id="kt_ecommerce_add_product_tags" name="tags" class="form-control mb-2" value="{{isset($item)?($item['tags']):old('tags')}}" />
                            <!--end::Input-->
                            <!--begin::Description-->
{{--                            <div class="text-muted fs-7">Add tags to a product.</div>--}}
                            <!--end::Description-->
                            <!--end::Input group-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Category & tags-->
                </div>
                <!--end::Aside column-->
                <!--begin::Main column-->
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                    <!--begin::Tab content-->
                    <div class="tab-content">
                        <!--begin::Tab pane-->
                        <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                            <div class="d-flex flex-column gap-7 gap-lg-10">
                                <!--begin::General options-->
                                <div class="card card-flush py-4">
                                    @include('validation.alerts')

                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">
                                        <!--begin::Tax-->
                                        <div class="d-flex flex-wrap gap-5">
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label class="form-label">{{__('lang.ar.name')}}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input disabled type="text" name="name_ar" class="form-control mb-2"
                                                       placeholder="{{__('lang.ar.name')}}" value="{{isset($item)?$item['name_ar']:old('name_ar')}}" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div disabled class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label class="form-label">{{__('lang.en.name')}}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input disabled type="text" name="name_en" class="form-control mb-2"
                                                       placeholder="{{__('lang.en.name')}}" value="{{isset($item)?$item['name_en']:old('name_en')}}" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end:Tax-->
                                        <!--begin::Tax-->
                                        <div class="d-flex flex-wrap gap-5">
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <label class="form-label">{{__('lang.ar.description')}}</label>
                                                <!--end::Label-->
                                                <!--begin::Editor-->
                                                <textarea disabled class="form-control" name="description_ar"  id="kt_ecommerce_add_product_description" rows="3">
                                                    {{isset($item)?$item['description_ar']:old('description_ar')}}
                                                </textarea>
                                                <!--end::Editor-->
                                                <input type="hidden" id="description_ar_hidden" value=" {{isset($item)?$item['description_ar']:''}}">
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <label class="form-label">{{__('lang.en.description')}}</label>
                                                <!--end::Label-->
                                                <!--begin::Editor-->
                                                <textarea disabled class="form-control" name="description_en"  id="kt_ecommerce_add_product_description_en" rows="3">
                                                     {{isset($item)?$item['description_en']:old('description_en')}}
                                                </textarea>
                                                <input type="hidden" id="description_en_hidden" value=" {{isset($item)?$item['description_en']:''}}">

                                                <!--end::Editor-->
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end:Tax-->
                                    <!--end::Card header-->
                                </div>

                            </div>
                        </div>

                        <!--end::Tab pane-->
                    </div>
                        <!--begin::Pricing-->
                        <div class="card card-flush py-4  mt-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>{{__('lang.price')}}</h2>
                                </div>
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Input group-->
                                <div class="mb-10 fv-row">
                                    <!--begin::Label-->
                                    <label class="required form-label">{{__('lang.Base Price')}}</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input disabled type="text" name="price" class="form-control mb-2" placeholder="{{__('lang.Base Price')}}" value="{{isset($item)?$item['price']:old('price')}}" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-10">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-bold mb-2">{{__('lang.Discount Type')}}
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" ></i></label>
                                    <!--End::Label-->
                                    <!--begin::Row-->
                                    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-1 row-cols-xl-3 g-9" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button='true']">
                                        <!--begin::Col-->
                                        <div class="col">
                                            <!--begin::Option-->
                                            <label class="btn btn-outline btn-outline-dashed btn-outline-default active d-flex text-start p-6" data-kt-button="true">
                                                <!--begin::Radio-->
                                                <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
																				<input disabled class="form-check-input" type="radio" name="discount_option" value="1" {{isset($item)?($item['discount_option'] == 1 ?'checked':''):''}} />
																			</span>
                                                <!--end::Radio-->
                                                <!--begin::Info-->
                                                <span class="ms-5">
																				<span class="fs-4 fw-bolder text-gray-800 d-block">{{__('lang.No Discount')}}</span>
																			</span>
                                                <!--end::Info-->
                                            </label>
                                            <!--end::Option-->
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col">
                                            <!--begin::Option-->
                                            <label class="btn btn-outline btn-outline-dashed btn-outline-default d-flex text-start p-6" data-kt-button="true">
                                                <!--begin::Radio-->
                                                <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
																				<input disabled class="form-check-input" type="radio" name="discount_option" value="2" {{isset($item)?($item['discount_option'] == 2 ?'checked':''):''}} />
																			</span>
                                                <!--end::Radio-->
                                                <!--begin::Info-->
                                                <span class="ms-5">
																				<span class="fs-4 fw-bolder text-gray-800 d-block">{{__('lang.Percentage')}} %</span>
																			</span>
                                                <!--end::Info-->
                                            </label>
                                            <!--end::Option-->
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col">
                                            <!--begin::Option-->
                                            <label class="btn btn-outline btn-outline-dashed btn-outline-default d-flex text-start p-6" data-kt-button="true">
                                                <!--begin::Radio-->
                                                <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
																				<input disabled class="form-check-input" type="radio" name="discount_option" value="3" {{isset($item)?($item['discount_option'] == 3 ?'checked':''):''}} />
																			</span>
                                                <!--end::Radio-->
                                                <!--begin::Info-->
                                                <span class="ms-5">
																				<span class="fs-4 fw-bolder text-gray-800 d-block">{{__('lang.Fixed Price')}}</span>
																			</span>
                                                <!--end::Info-->
                                            </label>
                                            <!--end::Option-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Row-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="{{isset($item)?($item['discount_option'] == 2 ?'':'d-none'):'d-none'}} mb-10 fv-row" id="kt_ecommerce_add_product_discount_percentage">
                                    <!--begin::Label-->
                                    <label class="form-label">{{__('lang.Set Discount Percentage')}}</label>
                                    <!--end::Label-->
                                    <!--begin::Slider-->
                                    <div class="d-flex flex-column text-center mb-5">
                                        <div class="d-flex align-items-start justify-content-center mb-7">
                                            <span class="fw-bolder fs-3x" id="kt_ecommerce_add_product_discount_label">{{isset($item)?($item['discount_option'] == 2 ?$item['discounted_price'] :0):0}}</span>
                                            <span class="fw-bolder fs-4 mt-1 ms-2">%</span>
                                            <input disabled type="hidden" name="discounted_percentage" class="form-control mb-2" id="discounted_percentage" value="{{isset($item)?($item['discount_option'] == 2 ?$item['discounted_price'] :0):0}}"  placeholder="{{__('lang.Discounted price')}}" />

                                        </div>
                                        <div id="kt_ecommerce_add_product_discount_slider" class="noUi-sm"></div>
                                    </div>
                                    <!--end::Slider-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="{{isset($item)?($item['discount_option'] == 3 ?'':'d-none'):'d-none'}}  mb-10 fv-row" id="kt_ecommerce_add_product_discount_fixed">
                                    <!--begin::Label-->
                                    <label class="form-label">{{__('lang.Fixed Discounted Price')}}</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input disabled type="text" name="discounted_price" class="form-control mb-2" value="{{isset($item)?($item['discount_option'] == 3 ?$item['discounted_price'] :old('discounted_price')):old('discounted_price')}}"  placeholder="{{__('lang.Discounted price')}}" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->

                            </div>
                            <!--end::Card header-->

                        </div>
                        <!--end::Pricing-->
                        <!--begin::Variations-->
                        <div class="card card-flush py-4 mt-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>{{__('lang.Quantity')}} - {{__('lang.branches')}}</h2>
                                </div>
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Input group-->
                                <div class="" >
                                    <div id="qtys">
                                        <!--begin::Form group-->
                                        <div class="form-group">
                                            @foreach($branches as $branch)
                                                <!--begin::Input group-->
                                                <div class="row mb-6">
                                                    <!--begin::Label-->
                                                    <label class="col-lg-3 col-form-label fw-bold fs-6">{{$branch->address}}</label>
                                                    <!--end::Label-->
                                                    <!--begin::Col-->
                                                    <div class="col-lg-4 fv-row">
                                                        <input disabled type="text" name="qty[{{$branch->id}}][]" class="form-control form-control-lg form-control-solid" placeholder="Company website" value="{{isset($item)?$branch->getQty($item['id']):0}}" />
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Input group-->
                                            @endforeach
                                        </div>
                                        <!--end::Form group-->
                                    </div>
                                    <!--end::Repeater-->
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Card header-->
                        </div>
                        <!--end::Variations-->

                        <!--begin::Variations-->
                        <div class="card card-flush py-4 mt-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>{{__('lang.addons')}}</h2>
                                </div>
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Input group-->
                                <div class="" data-kt-ecommerce-catalog-add-product="auto-options">
                                    <!--begin::Label-->
                                    {{--                                            <label class="form-label">{{__('lang.Add Product addons')}}</label>--}}
                                    <!--end::Label-->
                                    <!--begin::Repeater-->
                                    <div id="product_options">


                                        <!--begin::Form group-->
                                        <div class="form-group">
                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row">
                                                <div class="col-6">
                                                    <!--begin::Label-->
                                                    <label class="form-label">{{__('lang.max_addons')}}</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input disabled type="text" name="max_addons" class="form-control mb-2"
                                                           placeholder="{{__('lang.max_addons')}}" value="{{isset($item)?$item['max_addons']:old('max_addons')}}" />
                                                    <!--end::Input-->
                                                </div>
                                            </div>
                                            <!--end::Input group-->
                                            <div data-repeater-list="product_options" class="d-flex flex-column gap-3">
                                                @if(isset($item) && $item['product_addons'])
                                                    @foreach($item['product_addons'] as $item_addon)
                                                        <div data-repeater-item="" class="form-group d-flex flex-wrap gap-5">
                                                            <!--begin::Select2-->
                                                            <div class="w-100 w-md-200px">
                                                                <select disabled class="form-select" name="addon_id" data-placeholder="{{__('lang.select')}}" data-kt-ecommerce-catalog-add-product="product_option">
                                                                    <option></option>
                                                                    @foreach($addons  as $addon)
                                                                        <option value="{{$addon->id}}" {{$item_addon ==$addon->id ?'selected':'' }}>{{$addon->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <!--end::Select2-->
                                                            <!--begin::Input-->
                                                            {{--                                                            <input type="text" class="form-control mw-100 w-200px" name="product_option_value" placeholder="Variation" />--}}

                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <!--end::Form group-->
                                    </div>
                                    <!--end::Repeater-->
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Card header-->
                        </div>
                        <!--end::Variations-->

                        <!--begin::Media-->
                        <div class="card card-flush py-4 mt-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>{{__('lang.photos')}}</h2>
                                </div>
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Input group-->
                                @if(isset($item) && isset($item['photos']))
                                    <div class="fv-row mb-2">
                                        <div class="d-flex d-flex-custom mt-2">
                                            @foreach($item['photos'] as $photo)
                                                <div class="parent_div_photo" id="photo_{{$photo['id']}}">
                                                    <div class="image-input image-input-empty image-input-outline product-image" id="avatar"
                                                    >
                                                        <div class="image-input-wrapper bg-img" style="background-image: url({{ asset('storage/product-photos/'.$photo['name']) }})"></div>


                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <!--end::Card header-->
                        </div>
                    <!--end::Tab content-->
                </div>
                </div>
                <!--end::Main column-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
@endsection
@section('scripts')
    <script src="{{asset('')}}assets/js/custom/formrepeater.bundle.js"></script>
    <script src="{{asset('')}}assets/js/custom/save-product.js"></script>
    <script src="{{asset('')}}assets/js/custom/widgets.js"></script>
    <script>
        $(document).ready(function() {
            function fillTextArea() {
                $('#kt_ecommerce_add_product_description').html($('#description_ar_hidden').val())
                $('#kt_ecommerce_add_product_description_en').html($('#description_en_hidden').val())
                $('#discounted_percentage').val( $('#kt_ecommerce_add_product_discount_label').html())
            }
            fillTextArea()
        })
    </script>

@endsection
