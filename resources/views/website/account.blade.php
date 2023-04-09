@extends('website.layout.master')
@section('content')

    <!-- user -->
    <div class="user-data ">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mt-5 ">
                    <div class="user-body   ">
                        <div class="row row-cols-1 ">
                            <div class="col">
                                <div class="user-link user-item active-user my-3 p-2 pointer" id="myDataLink"
                                     onclick="toggleProfile()">
                                    <i class="fa-solid fa-circle-user fa-xl"></i>
                                    <span class="mx-2">{{__('my data')}}</span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="user-link orders-item  my-3 p-2 pointer" id="myOrdersLink"
                                     onclick="toggleMyOrders()">
                                    <i class="fa-solid fa-calendar-days fa-xl"></i>
                                    <span class="mx-2">{{__('my orders')}}</span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="user-link cash-item  my-3 p-2 pointer" id="cashBackLink"
                                     onclick="toggleCashBack()">
                                    <i class="fa-solid fa-cash-register fa-xl"></i>
                                    <span class="mx-2">{{__('Cashback')}}</span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="out-item  my-3 p-2 text-danger pointer"
                                     onclick="goToUrl('{{route('break.logout')}}') ; event.preventDefault(); window.localStorage.removeItem('fcm_token')">
                                    <i class="fa-solid fa-right-from-bracket fa-xl"></i>
                                    <span class="mx-2">{{__('Sign out')}}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="links-content col-md-8 orders data-form mt-5 d-none" id="cashBack">

                    <div class="discount bg-gray text-center p-3">
                        <div data-i18n="orderNumber">رصيد الكاش باك</div>
                    </div>
                    <div class="Refund-balance d-flex justify-content-between align-items-center mt-3">
                        <div class="Refund-text">
                            <img src="{{asset('')}}assets/website/images/icons/information.png" alt=""
                                 class="w-20px h-20px">
                            <span class="mx-2">{{__('you have refund balance')}}</span>
                        </div>
                        <div
                            class="Refund-num bg-main p-2 rounded">{{auth()->user()->balance}} {{__('productPrice')}}</div>

                    </div>
                    @php
                        $new_orders = auth()->user()->orders()->orderBy('created_at','desc')->take(10)->get();
                    @endphp
                    <div class="row row-cols-md-2 mt-3">
                        @if(count($new_orders) > 0)
                            <div class="col">
                                @foreach($new_orders as $index => $order)
                                    @if(calculateOrderCashback($order) > 0)
                                        @if($index % 2 == 0)
                                            <div class="product-item">
                                                <div class="card">
                                                    <div class="item-img position-relative">
                                                        <img src="{{$order->items[0]->product->avatar}}"
                                                             class="card-img-top" alt="product">
                                                        <div class="card-img-overlay">
                                            <span
                                                class="card-title shadow-sm bg-body p-2 color-main w-25 left rounded text-center">
                                                {{$order->created_at}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="card-body text-center">
                                                        @php $cachback = 0 @endphp
                                                        @foreach($order->items as $item)
                                                            @php $product = $item->product @endphp
                                                            @if($product->cachback > 0)
                                                                @php $cachback+=$product->cashback @endphp
                                                                <div
                                                                    class="discount d-flex justify-content-between bg-gray align-items-center p-2">
                                                                    <div
                                                                        data-i18n="discountText">{{__('productName')}}</div>
                                                                    <div
                                                                        data-i18n="percentage">{{$product->cachback}} {{__('productPrice')}}</div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                        <a href="#" class="text-dark  text-decoration-underline text-center"
                                                           data-i18n="viewDetails">{{__('viewDetails')}}</a>

                                                        <button class="btn btn-product new-order-btn w-100 mt-3">
                                                    <span class="mx-1"
                                                          data-i18n="recieveFromBranch">{{__('Cashback')}}  {{$cachback}} {{__('productPrice')}} </span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                @endforeach
                            </div>
                            <div class="col">
                                @foreach($new_orders as $index=>$order)
                                    @if(calculateOrderCashback($order) > 0)
                                    @if($index % 2 != 0)
                                        <div class="product-item">
                                            <div class="card">
                                                <div class="item-img position-relative">
                                                    <img src="{{$order->items[0]->product->avatar}}"
                                                         class="card-img-top" alt="product">
                                                    <div class="card-img-overlay">
                                            <span
                                                class="card-title shadow-sm bg-body p-2 color-main w-25 left rounded text-center">
                                                {{$order->created_at}}</span>
                                                    </div>
                                                </div>
                                                <div class="card-body text-center">
                                                    @php $cachback = 0 @endphp
                                                    @foreach($order->items as $item)
                                                        @php $product = $item->product @endphp
                                                        @if($product->cachback > 0)
                                                            @php $cachback+=$product->cashback @endphp
                                                            <div
                                                                class="discount d-flex justify-content-between bg-gray align-items-center p-2">
                                                                <div
                                                                    data-i18n="discountText">{{__('productName')}}</div>
                                                                <div
                                                                    data-i18n="percentage">{{$product->cachback}} {{__('productPrice')}}</div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                    <a href="#" class="text-dark  text-decoration-underline text-center"
                                                       data-i18n="viewDetails">{{__('viewDetails')}}</a>

                                                    <button class="btn btn-product new-order-btn w-100 mt-3">
                                                    <span class="mx-1"
                                                          data-i18n="recieveFromBranch">{{__('Cashback')}}  {{$cachback}} {{__('productPrice')}} </span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @endif
                                @endforeach
                            </div>
                        @else
                            <div class="empty-orders text-center mt-5">
                                <div class="empty-img mt-2">
                                    <img src="{{asset('')}}assets/website/images/Add to Cart-amico (1).png" alt="">
                                </div>
                                <p class="mt-3">{{__('you need to order')}}</p>
                                <a href="{{route('break.products.index',['branch_id' =>@$branch->id])}}"
                                   class="btn btn-product " style="width: 380px;">
                                    <span class="mx-1">{{__('go and order')}}</span>
                                    <img src="{{asset('')}}assets/website/images/sal-i.png" alt="" class="w-20px">
                                </a>
                            </div>
                        @endif

                    </div>


                </div>


                <div class="links-content col-md-8 orders data-form mt-5  d-none" id="myOrders">
                    <div class="row row-cols-md-2 ">

                        <div class="col">
                            <button class="btn new-orders-btn color-main w-100  p-md-3 p-0 d- " onclick="newOrders()"
                                    id="NewOrdersBtn">
                                <img src="{{asset('')}}assets/website/images/icons/new-order.png" alt=""
                                     class="w-20px ">
                                <span class="mx-2">{{__('New Orders')}}</span>


                            </button>
                        </div>
                        <div class="col">
                            <button class="btn recived-orders-btn color-main w-100 active-order  p-md-3 p-0"
                                    onclick="ordersHistory()"
                                    id="OrderHistoryBtn">
                                <img src="{{asset('')}}assets/website/images/icons/recieved-order.png" alt=""
                                     class="w-20px ">
                                <span class="mx-2">{{__('History Orders')}}</span>

                            </button>
                        </div>
                    </div>


                    @php
                        $new_orders = auth()->user()->orders()->where('status','!=','done')->orderBy('created_at','desc')->take(10)->get();
                    @endphp
                    <div class="row row-cols-lg-2 mt-3 d-none " id="NewOrders">
                        @if(count($new_orders) > 0)
                            <div class="col">
                                @foreach($new_orders as $index => $order)

                                    @if($index % 2 == 0)
                                        <div class="product-item">
                                            <div class="card">
                                                <div class="item-img position-relative">
                                                    <img src="{{$order->items[0]->product->avatar}}"
                                                         class="card-img-top" alt="product">
                                                    <div class="card-img-overlay">
                                            <span
                                                class="card-title shadow-sm bg-body p-2 color-main w-25 left rounded text-center">
                                                {{$order->created_at}}</span>
                                                    </div>
                                                </div>

                                                <div class="card-body text-center">
                                                    @foreach($order->items as $item)
                                                        <div
                                                            class="discount d-flex justify-content-between bg-gray align-items-center p-2">
                                                            <div data-i18n="discountText">{{__('productName')}}</div>
                                                            <div
                                                                data-i18n="percentage">{{$item->product->price}} {{__('productPrice')}}</div>
                                                        </div>
                                                    @endforeach
                                                    <a href="#" class="text-dark  text-decoration-underline text-center"
                                                       data-i18n="viewDetails">{{__('viewDetails')}}</a>

                                                    <button class="btn btn-product new-order-btn w-100 mt-3">
                                                    <span class="mx-1"
                                                          data-i18n="recieveFromBranch">{{__('recieve from branch')}}</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="col">
                                @foreach($new_orders as $index=>$order)
                                    @if($index % 2 != 0)
                                        <div class="product-item">
                                            <div class="card">
                                                <div class="item-img position-relative">
                                                    <img src="{{$order->items[0]->product->avatar}}"
                                                         class="card-img-top" alt="product">
                                                    <div class="card-img-overlay">
                                            <span
                                                class="card-title shadow-sm bg-body p-2 color-main w-25 left rounded text-center">
                                                {{$order->created_at}}</span>
                                                    </div>
                                                </div>

                                                <div class="card-body text-center">
                                                    @foreach($order->items as $item)
                                                        <div
                                                            class="discount d-flex justify-content-between bg-gray align-items-center p-2">
                                                            <div data-i18n="discountText">{{__('productName')}}</div>
                                                            <div
                                                                data-i18n="percentage">{{$item->product->price}} {{__('productPrice')}}</div>
                                                        </div>
                                                    @endforeach
                                                    <a href="#" class="text-dark  text-decoration-underline text-center"
                                                       data-i18n="viewDetails">{{__('viewDetails')}}</a>

                                                    <button class="btn btn-product new-order-btn w-100 mt-3">
                                                    <span class="mx-1"
                                                          data-i18n="recieveFromBranch">{{__('recieve from branch')}}</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @else
                            <div class="empty-orders text-center mt-5">
                                <div class="empty-img mt-2">
                                    <img src="{{asset('')}}assets/website/images/Add to Cart-amico (1).png" alt="">
                                </div>
                                <p class="mt-3">{{__('you need to order')}}</p>
                                <a href="{{route('break.products.index',['branch_id' =>@$branch->id])}}"
                                   class="btn btn-product " style="width: 380px;">
                                    <span class="mx-1">{{__('go and order')}}</span>
                                    <img src="{{asset('')}}assets/website/images/sal-i.png" alt="" class="w-20px">
                                </a>
                            </div>
                        @endif

                    </div>
                    @php
                        $history_orders = auth()->user()->orders()->where('status','=','done')->orderBy('created_at','desc')->take(10)->get();
                    @endphp
                    <div class="row row-cols-lg-2 mt-3 " id="OrderHistory">
                        @if(count($history_orders) > 0)
                            <div class="col">
                                @foreach($history_orders as $index => $order)

                                    @if($index % 2 == 0)
                                        <div class="product-item">
                                            <div class="card">
                                                <div class="item-img position-relative">
                                                    <img src="{{$order->items[0]->product->avatar}}"
                                                         class="card-img-top" alt="product">
                                                    <div class="card-img-overlay">
                                            <span
                                                class="card-title shadow-sm bg-body p-2 color-main w-25 left rounded text-center">
                                                {{$order->created_at}}</span>
                                                    </div>
                                                </div>

                                                <div class="card-body text-center">
                                                    @foreach($order->items as $item)
                                                        <div
                                                            class="discount d-flex justify-content-between bg-gray align-items-center p-2">
                                                            <div data-i18n="discountText">{{$item->product->name}}</div>
                                                            <div
                                                                data-i18n="percentage">{{$item->product->price}} {{__('productPrice')}}</div>
                                                        </div>
                                                    @endforeach
                                                    <a href="#" class="text-dark  text-decoration-underline text-center"
                                                       data-i18n="viewDetails">{{__('viewDetails')}}</a>

                                                    <button class="btn btn-outline-success w-100 mt-3">
                                                        <span class="mx-1">{{__('Received')}}</span>
                                                        <i class="fa-solid fa-calendar-check"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="col">
                                @foreach($history_orders as $index=>$order)
                                    @if($index % 2 != 0)
                                        <div class="product-item">
                                            <div class="card">
                                                <div class="item-img position-relative">
                                                    <img src="{{$order->items[0]->product->avatar}}"
                                                         class="card-img-top" alt="product">
                                                    <div class="card-img-overlay">
                                            <span
                                                class="card-title shadow-sm bg-body p-2 color-main w-25 left rounded text-center">
                                                {{$order->created_at}}</span>
                                                    </div>
                                                </div>

                                                <div class="card-body text-center">
                                                    @foreach($order->items as $item)
                                                        <div
                                                            class="discount d-flex justify-content-between bg-gray align-items-center p-2">
                                                            <div data-i18n="discountText">{{__('productName')}}</div>
                                                            <div
                                                                data-i18n="percentage">{{$item->product->price}} {{__('productPrice')}}</div>
                                                        </div>
                                                    @endforeach
                                                    <a href="#" class="text-dark  text-decoration-underline text-center"
                                                       data-i18n="viewDetails">{{__('viewDetails')}}</a>

                                                    <button class="btn btn-outline-success w-100 mt-3">
                                                        <span class="mx-1">{{__('Received')}}</span>
                                                        <i class="fa-solid fa-calendar-check"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @else
                            <div class="empty-orders text-center mt-5">
                                <div class="empty-img mt-2">
                                    <img src="{{asset('')}}assets/website/images/Add to Cart-amico (1).png" alt="">
                                </div>
                                <p class="mt-3">{{__('you need to order')}}</p>
                                <a href="{{route('break.products.index',['branch_id' =>@$branch->id])}}"
                                   class="btn btn-product " style="width: 380px;">
                                    <span class="mx-1">{{__('go and order')}}</span>
                                    <img src="{{asset('')}}assets/website/images/sal-i.png" alt="" class="w-20px">
                                </a>
                            </div>
                        @endif
                    </div>

                    @if(count($new_orders) == 0 && count($history_orders) == 0 && false)
                        <div class="empty-orders text-center mt-5">
                            <div class="empty-img mt-2">
                                <img src="{{asset('')}}assets/website/images/Add to Cart-amico (1).png" alt="">
                            </div>
                            <p class="mt-3">{{__('you need to order')}}</p>
                            <a href="#" class="btn btn-product " style="width: 380px;">
                                <span class="mx-1">{{__('go and order')}}</span>
                                <img src="{{asset('')}}assets/website/images/sal-i.png" alt="" class="w-20px">
                            </a>
                        </div>
                    @endif
                </div>


                <div class="links-content col-md-8  data-form mt-5 " id="myData">
                    <div class="row g-3 row-cols-md-2 row-cols-1 ">
                        <div class="col">
                            <label for="name" class="form-label">{{__('Name')}}</label>
                            <input type="text" class="form-control" name="name" value="{{auth()->user()->name}}"
                                   aria-label="First name" placeholder="ahmed">

                        </div>
                        <div class="col">
                            <label for="phone" class="form-label">{{__('Phone number')}}</label>
                            <input type="tel" class="form-control" aria-label="phone" name="phone"
                                   value="{{auth()->user()->phone}}" placeholder="012 826 78299">

                        </div>
                        <div class="col">
                            <label for="email" class="form-label">{{__('Email')}}</label>
                            <input type="email" class="form-control" aria-label="email" name="email"
                                   value="{{auth()->user()->email}}" placeholder="test@gmail.com">
                        </div>
                        <div class="col">
                            <label for="gender" class="form-label">{{__('Gender')}}</label>
                            <select class="form-select  gender" name="gender" aria-label="Default select example"
                                    placeholder="male">
                                <option
                                    value="{{\App\Constants\Enum::MALE}}" {{auth()->user()->gender == \App\Constants\Enum::MALE ?'selected':''}} >{{__('lang.male')}}</option>
                                <option
                                    value="{{\App\Constants\Enum::FEMALE}}" {{auth()->user()->gender == \App\Constants\Enum::FEMALE ?'selected':''}} >{{__('lang.female')}}</option>
                            </select>
                        </div>
                        <div class="col mt-4">
                            <button class="btn btn-product w-100">{{__('Save')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--../ user -->
@endsection

