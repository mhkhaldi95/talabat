@extends('website.layout.master')
@section('style')
    <style>
        .Categories .box-button{
            width:344px
        }

        .Categories img{
            width: 100%;
            border-radius: 8px;
        }
    </style>
@endsection
@section('content')

    <!-- the Section Start definition -->
    <div class="definition text-white">
        <div class="container aa">
            <div class="input-group mb-3">
                <span class="input-group-text span-bg px-3" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></span>
                <input type="search" class="form-control py-2" id="product_search" placeholder="ابــــــــــــحث" aria-label="search"
                       aria-describedby="basic-addon1">
            </div>
        </div>
        <div class="bg-def">
        </div>
    </div>
    <!-- the Section End  definition -->
    <!-- the Section Categories start -->
    <div class="Categories pb-5 pt-2">
        <div class="container">
            <a href="{{route('break.products.index',['branch_id'=>$branch->id])}}">
                <button class="item-butt px-4 my-4"> رجوع </button>
            </a>

            <div>
                <div class="row">
                    <div class="col-md-12 col-lg-8">
                        <div class="row" id="products">
                            @foreach($products as $index=>$product)
                                <div class="col-md-12 col-lg-6">
                                    <div class="cards text-center">
                                        <div class="box-cat-img">
                                            <img src="{{$product['has_photo']?@$product['photos'][0]['photo_path']:$product['master_photo']}}"/>
                                        </div>
                                        <div class="padd-r">
                                            <p class=" py-3 fs-3">{{$product['name']}}</p>
                                            <p class="pb-3 ">{{$product['description']}}
                                            </p>
                                        </div>
                                        <button
                                            data-product="{{ json_encode($product,TRUE)}}"
                                            data-product_photo="{{$product['has_photo']?@$product['photos'][0]['photo_path']:$product['master_photo']}}"
                                            class="open_product_modal box-button butt-mobile fs-5">
                                            ريـــال <span class="mx-2">
                                                          {{$product['price']}}
                                                      </span>
                                            <i class="fa-brands fa-shopify"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-4">
                        @if(!is_null($cart) && count($cart) > 0)
                            <div id="carts">
                                @php $total = 0 @endphp

                                <div class="box-card">
                                    @foreach($cart as $item)
                                        @php $total += $item['price'] * $item['quantity'] @endphp
                                        <div class=" card-item d-flex align-items-center justify-content-between">
                                            <div class="d-flex">
                                                <div class="img-item">
                                                    <img src="{{$item['photo']}}" alt="" width="90px"
                                                         height="90px">
                                                </div>
                                                <div class="me-2 d-flex flex-column align-items-between ">
                                                    <p>{{$item['name']}} </p>
                                                    <p class="pt-2">{{$item['price']}}
                                                        ريال</p>
                                                </div>
                                            </div>
                                            <div>
                                                <p class="red delete_from_cart"  data-id="{{$item['id']}}">حذف</p>
                                                <div>
                                                    <div class="qty-input mob-butt">
                                                        <button class="qty-count qty-count--add-in-cart ad" data-product="{{ json_encode($item,TRUE)}}"
                                                                type="button">
                                                            <span class="text-white">+</span></button>
                                                        <input class="product-qty ss" disabled type="text" name="product-qty"
                                                               value="{{$item['quantity']}}">
                                                        <button class="qty-count qty-count--minus-in-cart mi " data-product="{{ json_encode($item,TRUE)}}"
                                                                type="button">-</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="mb-3 box-tottl">
                                        <label for="formGroupExampleInput" class="form-label">الفاتورة</label>
                                        <input type="text" class="form-control" id="formGroupExampleInput" value="{{$total}}"
                                               placeholder="المجموع" disabled>
                                        <p class="text-muted under">* شاملة ضريبة القيمة المضافة </p>
                                    </div>
                                    @if(!\Auth::check())
                                        <button class="box-button fs-5" id="complete_order">
                                            اتمام الطلب الان
                                            {{$total}}
                                            ريال
                                            <i class="fa-brands fa-shopify"></i>
                                        </button>
                                    @endif
                                    @if( (\Auth::check() && \Auth::user()->role == \App\Constants\Enum::CUSTOMER))
                                        <button class="box-button fs-5" >
                                            <a href="#">
                                                اتمام الطلب الان
                                                {{$total}}
                                                ريال
                                                <i class="fa-brands fa-shopify"></i>
                                            </a>
                                        </button>

                                    @endif
                                </div>
                            </div>
                        @endif
                        <div>
                            <div id="carts">
                                @if(is_null($cart) || count($cart) == 0)
                                    <div class="text-center box-sala d-flex justify-content-center align-items-center flex-column">
                                        <i class="fa-brands fa-shopify text-muted box-i"></i>
                                        <p class="text-muted f">اضف منتجات للعربة</p>
                                    </div>
                                @endif
                            </div>

                            <div>
                                <select class="form-select py-2" >
                                    <option value="{{$branch->id}}" selected class="text-muted" disabled>استلام من : {{$branch->address}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('website.layout.modal')
@endsection
@section('script')
    <script src="{{asset('')}}assets/website/js/index.js"></script>


@endsection
