@php
    $total = 0  ;
    $cart = session()->get('cart')

@endphp



<button type="button" class="btn-close" data-bs-dismiss="modal"></button>

<div class="invoice-head ">
    <div class="img text-center">
        <img src="{{asset('')}}assets/website/bill (1).png" alt="" class="">
        <h5 class="ms-3 mt-2">invoice</h5>

    </div>
</div>
<div class="border-gray receit-products mb-2">

    <div class="discount bg-gray text-center p-2 mb-2">
        <div>order #{{lastOrderNumber()}}</div>
    </div>
    @if(!is_null($cart) && count($cart) > 0)
        @foreach($cart as $item)
            @php $total += $item['price'] * $item['quantity'] @endphp
            <div class="row mb-3 bg-gray">
                <div class="col-md-3">
                    <div class="bill-product-img" style="background-image: url('{{$item['photo']}}')"></div>
                </div>
                <div class="col-md-9 px-2">

                    <div class="d-flex justify-content-between align-items-center py-2">
                        <span class="fs-12" data-i18n="productName">{{$item['name']}}</span>
                        <span class="fs-12" data-i18n="productPrice">{{$item['price']}}  {{__('productPrice')}}</span>
                    </div>

{{--                    <div class="d-flex justify-content-between align-items-center py-2">--}}
{{--                        <span class="fs-12">50 SAR</span>--}}
{{--                        <span class="fs-12">5 pices</span>--}}
{{--                    </div>--}}
                </div>
            </div>
        @endforeach
    @endif
</div>

<div class="border-gray">


    <div class="total d-flex justify-content-between bg-gray align-items-center p-2 mt-3">
        <div data-i18n="totalText">{{__('totalText')}}</div>
        <div data-i18n="totalAmount">{{$total}}</div>
    </div>
    <div class="total d-flex justify-content-between bg-main  opacity align-items-center p-2 my-3 ">
        <div data-i18n="refundText" style="font-size: 14px;">{{__('refundText')}}</div>
        <div data-i18n="refundAmount">{{auth()->user()->balance}} {{__('productPrice')}}</div>
    </div>

    <a href="#" class="text-dark mb-3 text-decoration-underline" data-i18n="addedTax">{{__('addedTax')}}</a>
</div>



<div class="btn  bg-gray w-100 p-2 mt-3">
    <div class="d-flex align-items-center justify-content-center" id="online-payment">
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


<div class="btn  bg-gray w-100 p-2 mb-4">
    <div class="d-flex align-items-center justify-content-center" id="cash-payment">
        <img src="{{asset('')}}assets/website/images/money.png" alt="" style="width: 20px;">
        <span class="mx-2">money</span>
    </div>
</div>
