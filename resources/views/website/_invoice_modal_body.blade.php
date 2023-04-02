@php
    $total = 0  ;
    $cart = session()->get('cart')

@endphp
<div class="invoice-head ">
    <div class="img text-center">
        <img src="{{asset('')}}assets/website/images/bill (1).png" alt="" class="">
    </div>
    <h5 class="text-center">invoice</h5>
</div>
<div class="border-gray mb-2">

    <div class="discount bg-gray text-center p-2 mb-2">
        <div>order #{{lastOrderNumber()}}</div>
    </div>
    @if(!is_null($cart) && count($cart) > 0)
        @foreach($cart as $item)
            @php $total += $item['price'] * $item['quantity'] @endphp
            <div class="row mb-3 ">
                <div class="col-md-4">
                    <div class="bill-product-img" style="background-image: url('{{$item['photo']}}')"></div>
                </div>
                <div class="col-md-8">

                    <div class="d-flex justify-content-between align-items-center py-2">
                        <span class="fs-12" data-i18n="productName">{{$item['name']}}</span>
                        <span class="fs-12" data-i18n="productPrice">{{$item['price']}}  {{__('productPrice')}}</span>
                    </div>

                    {{--            <div class="d-flex justify-content-between align-items-center py-2">--}}
                    {{--                <span class="fs-12" >50 SAR</span>--}}
                    {{--                <span class="fs-12" >5 pices</span>--}}
                    {{--            </div>--}}
                </div>
            </div>
        @endforeach
    @endif

</div>

<div class="border-gray">

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
    <div class="total d-flex justify-content-between bg-main  opacity align-items-center p-2 my-3 ">
        <div data-i18n="refundText"> {{__('refundText')}}</div>
        <div data-i18n="refundAmount">{{auth()->user()->balance}} {{__('productPrice')}}</div>
    </div>

    <a href="#" class="text-dark mb-3 text-decoration-underline" data-i18n="addedTax">{{__('addedTax')}}</a>
</div>

<div class="btn  bg-gray w-100 p-2 mt-3" id="online-payment">
    <div class="d-flex align-items-center justify-content-center">
        <img src="{{asset('')}}assets/website/images/visa.png" alt="" style="width: 30px;">
        <span class="mx-2">visa</span>
    </div>
</div>

<div class="btn  bg-gray w-100 p-2 my-2">
    <div class="d-flex align-items-center justify-content-center" id="cashBack-payment">
        <img src="{{asset('')}}assets/website/images/refund.png" alt="" style="width: 20px;">
        <span class="mx-2">cashBack</span>
    </div>
</div>


<div class="btn  bg-gray w-100 p-2 mb-4" id="cash-payment">
    <div class="d-flex align-items-center justify-content-center">
        <img src="{{asset('')}}assets/website/images/money.png" alt="" style="width: 20px;">
        <span class="mx-2">money</span>
    </div>
</div>
