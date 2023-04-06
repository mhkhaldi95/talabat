@php $total = 0 @endphp
@if(!is_null($cart) && count($cart) > 0)

    @foreach($cart as $item)
        @php $total += $item['price'] * $item['quantity'] @endphp
        <div class="cart-card mb-3">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="{{$item['photo']}}"
                         class="img-fluid rounded-start h-100 w-100"
                         alt="">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <p data-i18n="productName">{{$item['name']}}</p>
                            <p class="text-danger pointer delete_from_cart"
                               data-i18n="remove"
                               data-id="{{$item['id']}}">{{__('remove')}}</p>
                        </div>
                        <div class="d-flex justify-content-between align-items-end">
                            <p data-i18n="productPrice">{{$item['price']}}  {{__('productPrice')}}</p>
                            <div
                                class="d-flex justify-content-center align-items-center h-100 p-3">
                                <button
                                    class="btn w25 bg-main increment qty-count qty-count--add-in-cart ad"
                                    data-product="{{ json_encode($item,TRUE)}}"
                                    data-qty="{{ $branch->getQty($item['id'])}}">
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
@endif
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

<p data-i18n="bill">Bill</p>
@if( session()->has('coupon') && !empty(session()->has('coupon')))
    <div class="discount d-flex justify-content-between bg-gray align-items-center p-2">
        <div data-i18n="discountText">{{__('discountText')}}</div>
        @if(session()->get('coupon')->type == \App\Constants\Enum::PERCENTAGE)
            <div data-i18n="percentage">{{session()->get('coupon')->discount}}%</div>
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
<div class="total d-flex justify-content-between bg-gray align-items-center p-2 mt-3">
    <div data-i18n="totalText">{{__('totalText')}}</div>
    <div data-i18n="totalAmount">{{$total}}</div>
</div>
<a href="#" class="text-dark mb-3 text-decoration-underline" data-i18n="addedTax">
    {{__('addedTax')}}
</a>
@if(\Auth::check() && auth()->user()->role == \App\Constants\Enum::CUSTOMER)
    <div
        class="total d-flex justify-content-between bg-main  opacity align-items-center p-2 my-3 ">
        <div data-i18n="refundText"> {{__('refundText')}}</div>
        <div
            data-i18n="refundAmount">{{auth()->user()->balance}} {{__('productPrice')}}</div>
    </div>
@endif
{{--                                    <a href="{{!\Auth::check()?'javascript:void(0)':route('payment.index',['branch_id' => $branch->id,'amount' => $total])}}" class="btn btn-product w-100"--}}
<a href="javascript:void(0)" class="btn btn-product w-100"
   id="{{!\Auth::check() ? 'complete_order' : (!is_null($cart) && count($cart) > 0 ?'openModalInvoice':'')}}"
>
    <span class="mx-1" data-i18n="productPrice">{{$total}}  {{__('productPrice')}}</span>
    <img src="{{asset('')}}assets/website/images/sal-i.png" alt="" class="w-20px">
</a>
