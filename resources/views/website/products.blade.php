@extends('website.layout.master')
@section('content')

    <section class="advanced-search my-4">
        <div class="container">
            <div class="search-head-title   ">
                <h4 class="mx-3 color-main " data-i18n="categories">{{__('categories')}}</h4>
            </div>
            <ul class="nav nav-tabs  " id="myTab" role="tablist">

                <li class="nav-item mb-2" role="presentation">
                    <button class="nav-link   color-main active" id="home-tab" data-bs-toggle="tab"
                            data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane"
                            aria-selected="true"><span data-i18n="all">{{__('all')}}</span></button>
                </li>
                @foreach($categories as $category)
                    <li class="nav-item mb-2" role="presentation">
                        <button class="nav-link  color-main" id="category_{{$category['id']}}" data-bs-toggle="tab"
                                data-bs-target="#category_{{$category['id']}}-pane"
                                type="button" role="tab" aria-controls="category_{{$category['id']}}-pane"
                                aria-selected="false">
                            <img src="{{asset('')}}assets/website/images/icons/دونات.svg" alt="" class="w-20px h-20px">

                            <span class="mx-1" data-i18n="productCat">{{$category['name']}}</span></button>
                    </li>
                @endforeach
            </ul>

        </div>
    </section>



    <section class="products mb-5">
        <div class="container">

            <div class="row">
                <div class="col-lg-8 mb-lg-0 mb-4">

                    <div class="tab-content" id="myTabContent">

                        @if(count($products) > 0)
                            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel"
                                 aria-labelledby="home-tab"
                                 tabindex="0">
                                <div class="row row-cols-md-2 row-cols-1 gy-4">
                                    <div class="col">
                                        @foreach($products as $index=>$product)
                                            @php
                                                $photo = $product['has_photo']?@$product['photos'][0]['photo_path']:$product['master_photo']
                                            @endphp
                                            @if($index % 2 == 0)
                                                <div class="product-item">
                                                    <div class="card">

                                                        <div class="image">
                                                            <div class="img" data-source="image" style="background-image: url('{{$photo}}');">

                                                            </div>
                                                        </div>
{{--                                                        <img  src="{{$photo}}" class="card-img-top" alt="product">--}}
                                                        <div class="card-body text-center">
                                                            <h5 class="card-title"
                                                                data-i18n="productName">{{$product['name']}}</h5>
                                                            <div style="height: 55px">
                                                                <p class="card-text" style="text-overflow: ellipsis;overflow: hidden;white-space: nowrap" data-i18n="productText">
                                                                    {{$product['description']}}
                                                                </p>
                                                            </div>

                                                            <a href="javascript:void(0)"
                                                               data-product="{{ json_encode($product,TRUE)}}"
                                                               data-qty="{{ $branch->getQty($product['id'])}}"
                                                               data-product_photo="{{$product['has_photo']?@$product['photos'][0]['photo_path']:$product['master_photo']}}"
                                                               class="btn btn-product w-100 open_product_modal">
                                                                <span class="mx-1"
                                                                      data-i18n="productPrice"> {{$product['price']}} {{__('productPrice')}} </span>
                                                                <img src="{{asset('')}}assets/website/images/sal-i.png"
                                                                     alt="" class="w-20px">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="col">
                                        @foreach($products as $index=>$product)
                                            @php
                                                $photo = $product['has_photo']?@$product['photos'][0]['photo_path']:$product['master_photo']
                                            @endphp
                                            @if($index % 2 != 0)
                                                <div class="product-item">
                                                    <div class="card">

                                                        <div class="image">
                                                            <div class="img" data-source="image" style="background-image: url('{{$photo}}');">

                                                            </div>
                                                        </div>
                                                        <div class="card-body text-center">
                                                            <h5 class="card-title"
                                                                data-i18n="productName">{{$product['name']}}</h5>
                                                            <div style="height: 55px">
                                                                <p class="card-text" style="text-overflow: ellipsis;overflow: hidden;white-space: nowrap" data-i18n="productText">
                                                                    {{$product['description']}}
                                                                </p>
                                                            </div>

                                                            <a href="javascript:void(0)"
                                                               data-product="{{ json_encode($product,TRUE)}}"
                                                               data-qty="{{ $branch->getQty($product['id'])}}"
                                                               data-product_photo="{{$product['has_photo']?@$product['photos'][0]['photo_path']:$product['master_photo']}}"
                                                               class="btn btn-product w-100 open_product_modal">
                                                                <span class="mx-1"
                                                                      data-i18n="productPrice"> {{$product['price']}} {{__('productPrice')}} </span>
                                                                <img src="{{asset('')}}assets/website/images/sal-i.png"
                                                                     alt="" class="w-20px">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>


                                </div>

                            </div>
                        @endif
                        @foreach($categories as $category)
                            <div class="tab-pane fade" id="category_{{$category['id']}}-pane" role="tabpanel"
                                 aria-labelledby="donuts-tab"
                                 tabindex="0">
                                @if(count($category['products']) > 0)
                                    <div class="row row-cols-md-2 row-cols-1 gy-4">
                                        <div class="col">
                                            @foreach($category['products'] as $index=>$product)
                                                @php
                                                    $photo = $product['has_photo']?@$product['photos'][0]['photo_path']:$product['master_photo']
                                                @endphp
                                                @if($index % 2 == 0)
                                                    <div class="product-item">
                                                        <div class="card">

                                                            <div class="image">
                                                                <div class="img" data-source="image" style="background-image: url('{{$photo}}');">

                                                                </div>
                                                            </div>
                                                            <div class="card-body text-center">
                                                                <h5 class="card-title"
                                                                    data-i18n="productName">{{$product['name']}}</h5>
                                                                <div style="height: 55px">
                                                                    <p class="card-text" style="text-overflow: ellipsis;overflow: hidden;white-space: nowrap" data-i18n="productText">
                                                                        {{$product['description']}}
                                                                    </p>
                                                                </div>

                                                                <a href="javascript:void(0)"
                                                                   data-product="{{ json_encode($product,TRUE)}}"
                                                                   data-qty="{{ $branch->getQty($product['id'])}}"
                                                                   data-product_photo="{{$product['has_photo']?@$product['photos'][0]['photo_path']:$product['master_photo']}}"
                                                                   class="btn btn-product w-100 open_product_modal">
                                                                <span class="mx-1"
                                                                      data-i18n="productPrice"> {{$product['price']}} {{__('productPrice')}} </span>
                                                                    <img src="{{asset('')}}assets/website/images/sal-i.png"
                                                                         alt="" class="w-20px">
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="col">
                                            @foreach($category['products'] as $index=>$product)
                                                @php
                                                    $photo = $product['has_photo']?@$product['photos'][0]['photo_path']:$product['master_photo']
                                                @endphp
                                                @if($index % 2 != 0)
                                                    <div class="product-item">
                                                        <div class="card">

                                                            <div class="image">
                                                                <div class="img" data-source="image" style="background-image: url('{{$photo}}');">

                                                                </div>
                                                            </div>
                                                            <div class="card-body text-center">
                                                                <h5 class="card-title"
                                                                    data-i18n="productName">{{$product['name']}}</h5>
                                                                <div style="height: 55px">
                                                                    <p class="card-text" style="text-overflow: ellipsis;overflow: hidden;white-space: nowrap" data-i18n="productText">
                                                                        {{$product['description']}}
                                                                    </p>
                                                                </div>

                                                                <a href="javascript:void(0)"
                                                                   data-product="{{ json_encode($product,TRUE)}}"
                                                                   data-qty="{{ $branch->getQty($product['id'])}}"
                                                                   data-product_photo="{{$product['has_photo']?@$product['photos'][0]['photo_path']:$product['master_photo']}}"
                                                                   class="btn btn-product w-100 open_product_modal">
                                                                <span class="mx-1"
                                                                      data-i18n="productPrice"> {{$product['price']}} {{__('productPrice')}} </span>
                                                                    <img src="{{asset('')}}assets/website/images/sal-i.png"
                                                                         alt="" class="w-20px">
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>


                                    </div>
                                @endif
                            </div>
                        @endforeach

                    </div>

                </div>
                @php $total = 0 @endphp
                <div class="col-lg-4">
                    <div class="cart-car">
                        <div class="card h-100 w-100">
                            <div class="dropdown">

                                <div class=" d-flex cart-branch  align-items-center shadow-sm rounded p-3  w-100 dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                     aria-expanded="false"  style="color: #818080;">
                                    <div class="recieve" style="margin-left: 130px;">
                                        <img src="{{asset('')}}assets/website/images/bag-i.png" alt="" style="width: 25px;">
                                        <span class="mx-2 recieve-from " data-i18n="recieveFrom" style="color: #909090;">{{__('recieveFrom')}}</span>
                                    </div>
                                    <div class="">{{$branch->address}}</div>
                                </div>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="#" data-i18n="branchName">{{$branch->address}}</a>
                                    </li>
                                </ul>
                            </div>

                            <div id="carts">
                                @if(!is_null($cart) && count($cart) > 0)
                                    <div class="fill">
                                        @foreach($cart as $item)
                                            @php $total += $item['price'] * $item['quantity'] @endphp
                                            <div class="cart-card mb-3">
                                                <div class="row g-0 bg-gray">
                                                    <div class="col-md-3">
                                                        <img src="{{$item['photo']}}"
                                                             class="img-fluid rounded-start "
                                                             alt="">
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="px-2 py-1 ">
                                                            <div class="d-flex justify-content-between mb-1">
                                                                <span data-i18n="productName">{{$item['name']}}</span>
                                                                <span class="text-danger pointer delete_from_cart"
                                                                      data-id="{{$item['id']}}"
                                                                      data-i18n="remove">{{__('remove')}}</span>
                                                            </div>
                                                            <div class="d-flex justify-content-between align-items-end">
                                                                <span
                                                                    data-i18n="productPrice">{{$item['price']}}  {{__('productPrice')}}</span>
                                                                <div
                                                                    class="d-flex justify-content-center align-items-center h-100 p-1">
                                                                    <button
                                                                        class="btn w25 bg-main increment qty-count qty-count--add-in-cart ad"
                                                                        data-product="{{ json_encode($item,TRUE)}}"
                                                                        data-qty="{{ $branch->getQty($product['id'])}}">
                                                                        <i class="fa-solid fa-plus"></i>
                                                                    </button>
                                                                    <span id="root"
                                                                          class="counter-container product-qty">{{$item['quantity']}}</span>
                                                                    <button
                                                                        class="btn w25 decrement qty-count qty-count--minus-in-cart mi "
                                                                        data-product="{{ json_encode($item,TRUE)}}">
                                                                        <i class="fa-solid fa-minus"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="input-group mb-3">
                                          <span class="input-group-text">
                                            <i class="fa-solid fa-fire "></i>
                                          </span>
                                            <input type="text" class="form-control" id="coupon_value"
                                                   aria-label="Amount (to the nearest dollar)">

                                            <span class="input-group-text bg-main pointer" id="completion_coupon"
                                                  data-branch-id="{{$branch->id}}"
                                                  data-i18n="completion">{{__('completion')}}</span>
                                        </div>
                                        <div class="bill">
                                            <p>Bill</p>
                                            @if( session()->has('coupon') && !empty(session()->has('coupon')))
                                                <div
                                                    class="discount d-flex justify-content-between bg-gray align-items-center p-2">
                                                    <div data-i18n="discountText">{{__('discountText')}}</div>
                                                    @if(session()->get('coupon')->type == \App\Constants\Enum::PERCENTAGE)
                                                        <div
                                                            data-i18n="percentage">{{session()->get('coupon')->discount}}
                                                            %
                                                        </div>
                                                        @php
                                                            $total = $total -  (($total * session()->get('coupon')->discount)/100);
                                                            $total = round($total)
                                                        @endphp
                                                    @else
                                                        <div
                                                            data-i18n="percentage">{{session()->get('coupon')->discount}} {{__('productPrice')}} </div>
                                                        @php
                                                            $total = $total -  (session()->get('coupon')->discount);
                                                            $total = round($total)
                                                        @endphp
                                                    @endif
                                                </div>
                                            @endif
                                        </div>

                                        <div
                                            class="total d-flex justify-content-between bg-gray align-items-center p-2 mt-3">
                                            <div data-i18n="totalText">{{__('totalText')}}</div>
                                            <div data-i18n="totalAmount">{{$total}}</div>
                                        </div>
                                        <a href="#" class="text-dark mb-3 text-decoration-underline"
                                           data-i18n="addedTax">
                                            {{__('addedTax')}}
                                        </a>
                                        @if(\Auth::check() && auth()->user()->role == \App\Constants\Enum::CUSTOMER)
                                            <div
                                                class="total d-flex justify-content-between bg-main  opacity align-items-center p-2 my-3 ">
                                                <div data-i18n="refundText">{{__('refundText')}}</div>
                                                <div
                                                    data-i18n="refundAmount">{{auth()->user()->balance}} {{__('productPrice')}}</div>
                                            </div>
                                        @endif
                                        <a href="javascript:void(0)" class="btn btn-product w-100"
                                           id="{{!\Auth::check() ? 'complete_order' : (!is_null($cart) && count($cart) > 0 ?'openModalInvoice':'')}}"
                                        >
{{--                                            <span class="mx-1" data-i18n="productPrice">{{$total}}  {{__('productPrice')}}</span>--}}
                                            <span class="mx-1" data-i18n="productPrice">   {{__('Complete the order now')}}{{$total}}   {{__('productPrice')}}  </span>
                                            <img src="{{asset('')}}assets/website/images/sal-i.png" alt=""
                                                 class="w-20px">
                                        </a>
                                    </div>
                                @else
                                    <div class="empty text-center  mt-5">
                                        <div class="empty-img">
                                            <img src="{{asset('')}}assets/website/images/cart-bag.png" alt="">
                                        </div>
                                        <p class="mt-3 color-low-dark">{{__('the bag is empty')}}</p>
                                    </div>
                                @endif


                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
        </div>
        </div>
    </section>
    <!-- ../products -->
    @include('website.layout.modal')
@endsection


