<div class="box-card">
    @foreach($cart as $item)
        <div class=" card-item d-flex align-items-center justify-content-between">
        <div class="d-flex">
            <div class="img-item">
                <img src="{{$item['photo']}}" alt="" width="90px"
                     height="90px">
            </div>
            <div class="me-2 d-flex flex-column align-items-between ">
                <p>{{$item['name']}} </p>
                <p class="pt-2">٥٠ ريال</p>
            </div>
        </div>
        <div>
            <p class="red">حذف</p>
            <div>
                <div class="qty-input mob-butt">
                    <button class="qty-count qty-count--add ad" data-action="add"
                            type="button">
                        <span class="text-white">+</span></button>
                    <input class="product-qty ss" type="text" disabled name="product-qty"
                           value="{{$item['quantity']}}">
                    <button class="qty-count qty-count--minus mi " data-action="minus"
                            type="button">-</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <div class="mb-3 box-tottl">
        <label for="formGroupExampleInput" class="form-label">الفاتورة</label>
        <input type="text" class="form-control" id="formGroupExampleInput"
               placeholder="المجموع" disabled>
        <p class="text-muted under">* شاملة ضريبة القيمة المضافة </p>
    </div>
    <button class="box-button fs-5">
        اتمام الطلب الان ٧٧ ريال
        <i class="fa-brands fa-shopify"></i>
    </button>
</div>
