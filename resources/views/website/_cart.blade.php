@php $total = 0 @endphp
@if(isset($cart) && count($cart) > 0)
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
            <p class="red" id="delete_from_cart" data-id="{{$item['id']}}">حذف</p>
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
        @if(!\Auth::check() || (\Auth::check() && \Auth::user()->role == \App\Constants\Enum::CUSTOMER))
            <button class="box-button fs-5" id="complete_order">
                اتمام الطلب الان
                {{$total}}
                ريال
                <i class="fa-brands fa-shopify"></i>
            </button>
        @endif
</div>
@endif
<div id="carts">
    @if(is_null($cart) || count($cart) == 0)
        <div class="text-center box-sala d-flex justify-content-center align-items-center flex-column">
            <i class="fa-brands fa-shopify text-muted box-i"></i>
            <p class="text-muted f">اضف منتجات للعربة</p>
        </div>
    @endif
</div>
<script>
    $(window).ready(function () {


        $('.qty-count--add-in-cart').click("on",function() {
            var qty = parseInt($(this).parent().find("input").val())+1;
            var product = $(this).data('product')
            console.log("product",product)
            $(this).parent().find("input").val(qty)
            axios.post('{{route('add-to-cart')}}',{product_id:product.id,product_qty:qty,plus_one:true}).then(function (response) {
                if(response.data.data){
                    $('#carts').html(response.data.data)
                }
            })
        })
        $('.qty-count--minus-in-cart').click("on",function() {
            var qty = parseInt($(this).parent().find("input").val())-1;
            var product = $(this).data('product')
            $(this).parent().find("input").val(qty)
            axios.post('{{route('minus')}}',{product_id:product.id,product_qty:qty,minus_one:true}).then(function (response) {
                if(response.data.data){
                    $('#carts').html(response.data.data)
                }
            })
        })
        $('#delete_from_cart').click("on",function() {
            var id = $(this).data('id')
            axios.post('{{route('delete-from-cart')}}',{id:id}).then(function (response) {
                if(response.data.data){
                    $('#carts').html(response.data.data)
                }
            })
        })
        $('#complete_order').click("on",function() {
            $('#modal-mobile-login').modal("show")
        })


    })
</script>
