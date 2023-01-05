@extends('website.layout.master')
@section('content')
    <div class="Categories pb-5 pt-2">
        <div class="container">
            <p class="fs-3 colors">{{__('lang.ategories')}} :</p>
            <div>
                <ul class="nav nav-pills mb-2" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="btn active item-butt px-3" id="all" data-bs-toggle="pill" data-bs-target="#all"
                                type="button" role="tab" aria-controls="pills-home" aria-selected="true">  الكل
                        </button>
                    </li>

                    @foreach($categories as $category)
                        <li class="nav-item " role="presentation">
                            <button class="btn item-butt  me-2 px-3" id="category_{{$category->id}}" data-bs-toggle="pill" data-bs-target="#category_{{$category->id}}"
                                    type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
                                <img src="{{asset('')}}assets/website/img/don.png" alt="" width="20px" class="zz ps-1"> {{$category->name}}</button>
                        </li>
                    @endforeach
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="row">
                            <div class="col-md-12 col-lg-4">
                                <div class="cards text-center">
                                    <DIV class="box-cat-img">
                                        <IMG src="{{asset('')}}assets/website/img/Screenshot 2022-12-08 at 1.36.33 PM.png"></IMG>
                                    </DIV>
                                    <div class="padd-r">
                                        <p class=" py-3 fs-3">جليز</p>
                                        <p class="pb-3 ">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص
                                            العربى
                                        </p>
                                    </div>
                                    <button class="box-button butt-mobile fs-5">
                                        ريـــال <span class="mx-2"> 7 </span>
                                        <i class="fa-brands fa-shopify"></i>
                                    </button>
                                </div>
                                <div class="cards text-center">
                                    <DIV class="box-cat-img">
                                        <IMG src="{{asset('')}}assets/website/img/Screenshot 2022-12-08 at 1.36.33 PM.png"></IMG>
                                    </DIV>
                                    <div class="padd-r">
                                        <p class=" py-3 fs-3">جليز</p>
                                        <p class="pb-3 ">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص
                                            العربى
                                        </p>
                                    </div>
                                    <button class="box-button butt-mobile fs-5">
                                        ريـــال <span class="mx-2"> 7 </span>
                                        <i class="fa-brands fa-shopify"></i>
                                    </button>
                                </div>
                                <div class="cards text-center">
                                    <DIV class="box-cat-img">
                                        <IMG src="{{asset('')}}assets/website/img/Screenshot 2022-12-08 at 1.36.33 PM.png"></IMG>
                                    </DIV>
                                    <div class="padd-r">
                                        <p class=" py-3 fs-3">جليز</p>
                                        <p class="pb-3 ">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص
                                            العربى
                                        </p>
                                    </div>
                                    <button class="box-button butt-mobile fs-5">
                                        ريـــال <span class="mx-2"> 7 </span>
                                        <i class="fa-brands fa-shopify"></i>
                                    </button>
                                </div>
                                <div class="cards text-center">
                                    <DIV class="box-cat-img">
                                        <IMG src="{{asset('')}}assets/website/img/Screenshot 2022-12-08 at 1.36.33 PM.png"></IMG>
                                    </DIV>
                                    <div class="padd-r">
                                        <p class=" py-3 fs-3">جليز</p>
                                        <p class="pb-3 ">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص
                                            العربى
                                        </p>
                                    </div>
                                    <button class="box-button butt-mobile fs-5">
                                        ريـــال <span class="mx-2"> 7 </span>
                                        <i class="fa-brands fa-shopify"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4">
                                <div class="cards text-center">
                                    <DIV class="box-cat-img">
                                        <IMG src="{{asset('')}}assets/website/img/Screenshot 2022-12-08 at 1.36.33 PM.png"></IMG>
                                    </DIV>
                                    <div class="padd-r">
                                        <p class=" py-3 fs-3">جليز</p>
                                        <p class="pb-3 ">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص
                                            العربى
                                        </p>
                                    </div>
                                    <button class="box-button butt-mobile fs-5">
                                        ريـــال <span class="mx-2"> 7 </span>
                                        <i class="fa-brands fa-shopify"></i>
                                    </button>
                                </div>
                                <div class="cards text-center">
                                    <DIV class="box-cat-img">
                                        <IMG src="{{asset('')}}assets/website/img/Screenshot 2022-12-08 at 1.36.33 PM.png"></IMG>
                                    </DIV>
                                    <div class="padd-r">
                                        <p class=" py-3 fs-3">جليز</p>
                                        <p class="pb-3 ">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص
                                            العربى
                                        </p>
                                    </div>
                                    <button class="box-button butt-mobile fs-5">
                                        ريـــال <span class="mx-2"> 7 </span>
                                        <i class="fa-brands fa-shopify"></i>
                                    </button>
                                </div>
                                <div class="cards text-center">
                                    <DIV class="box-cat-img">
                                        <IMG src="{{asset('')}}assets/website/img/Screenshot 2022-12-08 at 1.36.33 PM.png"></IMG>
                                    </DIV>
                                    <div class="padd-r">
                                        <p class=" py-3 fs-3">جليز</p>
                                        <p class="pb-3 ">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص
                                            العربى
                                        </p>
                                    </div>
                                    <button class="box-button butt-mobile fs-5">
                                        ريـــال <span class="mx-2"> 7 </span>
                                        <i class="fa-brands fa-shopify"></i>
                                    </button>
                                </div>
                                <div class="cards text-center">
                                    <DIV class="box-cat-img">
                                        <IMG src="{{asset('')}}assets/website/img/Screenshot 2022-12-08 at 1.36.33 PM.png"></IMG>
                                    </DIV>
                                    <div class="padd-r">
                                        <p class=" py-3 fs-3">جليز</p>
                                        <p class="pb-3 ">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص
                                            العربى
                                        </p>
                                    </div>
                                    <button class="box-button butt-mobile fs-5">
                                        ريـــال <span class="mx-2"> 7 </span>
                                        <i class="fa-brands fa-shopify"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4">
                                <div class="">
                                    <div class="text-center box-sala d-flex justify-content-center align-items-center flex-column">
                                        <i class="fa-brands fa-shopify text-muted box-i"></i>
                                        <p class="text-muted f">اضف منتجات للعربة</p>
                                    </div>
                                    <div>
                                        <select class="form-select py-2" aria-label="Default select example">
                                            <option selected class="text-muted"> استلام من : السعودية بريدة </option>
                                            <option value="1" class="text-muted">استلام من : السعودية بريدة</option>
                                            <option value="2" class="text-muted">استلام من : السعودية بريدة</option>
                                            <option value="3" class="text-muted">استلام من : السعودية بريدة</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @foreach($categories as $category)
                      <div class="tab-pane fade" id="category_{{$category->id}}" role="tabpanel" aria-labelledby="category_{{$category->id}}">
                        <div class="row">
                            <div class="col-md-12 col-lg-4">
                                <div class="cards text-center">
                                    <DIV class="box-cat-img">
                                        <IMG src="{{asset('')}}assets/website/img/Screenshot 2022-12-08 at 1.36.33 PM.png"></IMG>
                                    </DIV>
                                    <div class="padd-r">
                                        <p class=" py-3 fs-3">جليز</p>
                                        <p class="pb-3 ">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص
                                            العربى
                                        </p>
                                    </div>
                                    <button class="box-button butt-mobile fs-5">
                                        ريـــال <span class="mx-2"> 7 </span>
                                        <i class="fa-brands fa-shopify"></i>
                                    </button>
                                </div>
                                <div class="cards text-center">
                                    <DIV class="box-cat-img">
                                        <IMG src="{{asset('')}}assets/website/img/Screenshot 2022-12-08 at 1.36.33 PM.png"></IMG>
                                    </DIV>
                                    <div class="padd-r">
                                        <p class=" py-3 fs-3">جليز</p>
                                        <p class="pb-3 ">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص
                                            العربى
                                        </p>
                                    </div>
                                    <button class="box-button butt-mobile fs-5">
                                        ريـــال <span class="mx-2"> 7 </span>
                                        <i class="fa-brands fa-shopify"></i>
                                    </button>
                                </div>
                                <div class="cards text-center">
                                    <DIV class="box-cat-img">
                                        <IMG src="{{asset('')}}assets/website/img/Screenshot 2022-12-08 at 1.36.33 PM.png"></IMG>
                                    </DIV>
                                    <div class="padd-r">
                                        <p class=" py-3 fs-3">جليز</p>
                                        <p class="pb-3 ">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص
                                            العربى
                                        </p>
                                    </div>
                                    <button class="box-button butt-mobile fs-5">
                                        ريـــال <span class="mx-2"> 7 </span>
                                        <i class="fa-brands fa-shopify"></i>
                                    </button>
                                </div>
                                <div class="cards text-center">
                                    <DIV class="box-cat-img">
                                        <IMG src="{{asset('')}}assets/website/img/Screenshot 2022-12-08 at 1.36.33 PM.png"></IMG>
                                    </DIV>
                                    <div class="padd-r">
                                        <p class=" py-3 fs-3">جليز</p>
                                        <p class="pb-3 ">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص
                                            العربى
                                        </p>
                                    </div>
                                    <button class="box-button butt-mobile fs-5">
                                        ريـــال <span class="mx-2"> 7 </span>
                                        <i class="fa-brands fa-shopify"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4">
                                <div class="cards text-center">
                                    <DIV class="box-cat-img">
                                        <IMG src="{{asset('')}}assets/website/img/Screenshot 2022-12-08 at 1.36.33 PM.png"></IMG>
                                    </DIV>
                                    <div class="padd-r">
                                        <p class=" py-3 fs-3">جليز</p>
                                        <p class="pb-3 ">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص
                                            العربى
                                        </p>
                                    </div>
                                    <button class="box-button butt-mobile fs-5">
                                        ريـــال <span class="mx-2"> 7 </span>
                                        <i class="fa-brands fa-shopify"></i>
                                    </button>
                                </div>
                                <div class="cards text-center">
                                    <DIV class="box-cat-img">
                                        <IMG src="{{asset('')}}assets/website/img/Screenshot 2022-12-08 at 1.36.33 PM.png"></IMG>
                                    </DIV>
                                    <div class="padd-r">
                                        <p class=" py-3 fs-3">جليز</p>
                                        <p class="pb-3 ">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص
                                            العربى
                                        </p>
                                    </div>
                                    <button class="box-button butt-mobile fs-5">
                                        ريـــال <span class="mx-2"> 7 </span>
                                        <i class="fa-brands fa-shopify"></i>
                                    </button>
                                </div>
                                <div class="cards text-center">
                                    <DIV class="box-cat-img">
                                        <IMG src="{{asset('')}}assets/website/img/Screenshot 2022-12-08 at 1.36.33 PM.png"></IMG>
                                    </DIV>
                                    <div class="padd-r">
                                        <p class=" py-3 fs-3">جليز</p>
                                        <p class="pb-3 ">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص
                                            العربى
                                        </p>
                                    </div>
                                    <button class="box-button butt-mobile fs-5">
                                        ريـــال <span class="mx-2"> 7 </span>
                                        <i class="fa-brands fa-shopify"></i>
                                    </button>
                                </div>
                                <div class="cards text-center">
                                    <DIV class="box-cat-img">
                                        <IMG src="{{asset('')}}assets/website/img/Screenshot 2022-12-08 at 1.36.33 PM.png"></IMG>
                                    </DIV>
                                    <div class="padd-r">
                                        <p class=" py-3 fs-3">جليز</p>
                                        <p class="pb-3 ">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص
                                            العربى
                                        </p>
                                    </div>
                                    <button class="box-button butt-mobile fs-5">
                                        ريـــال <span class="mx-2"> 7 </span>
                                        <i class="fa-brands fa-shopify"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4">
                                <div class="">
                                    <div class="text-center box-sala d-flex justify-content-center align-items-center flex-column">
                                        <i class="fa-brands fa-shopify text-muted box-i"></i>
                                        <p class="text-muted f">اضف منتجات للعربة</p>
                                    </div>
                                    <div>
                                        <select class="form-select py-2" aria-label="Default select example">
                                            <option selected class="text-muted"> استلام من : السعودية بريدة </option>
                                            <option value="1" class="text-muted">استلام من : السعودية بريدة</option>
                                            <option value="2" class="text-muted">استلام من : السعودية بريدة</option>
                                            <option value="3" class="text-muted">استلام من : السعودية بريدة</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
