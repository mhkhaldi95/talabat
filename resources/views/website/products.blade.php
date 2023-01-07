@extends('website.layout.master')
@section('content')
    <div class="Categories pb-5 pt-2">
        <div class="container">
            <p class="fs-3 colors">{{__('lang.categories')}} :</p>
            <div>
                <ul class="nav nav-pills mb-2" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="btn active item-butt px-3" id="all" data-bs-toggle="pill" data-bs-target="#target_all"
                                type="button" role="tab" aria-controls="pills-home" aria-selected="true">  الكل
                        </button>
                    </li>
                    @foreach($categories as $category)
                        <li class="nav-item " role="presentation">
                            <button class="btn item-butt  me-2 px-3" id="category_{{$category['id']}}" data-bs-toggle="pill" data-bs-target="#target_category_{{$category['id']}}"
                                    type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
                                <img src="{{asset('')}}assets/website/img/don.png" alt="" width="20px" class="zz ps-1"> {{$category['name']}}</button>
                        </li>
                    @endforeach
                </ul>
                <div class="row">
                    <div class="tab-content col-md-12 col-lg-8" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="target_all" role="tabpanel" aria-labelledby="all">
                            @if(count($products) > 0)
                                <div class="row">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="row">
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

                                </div>
                            @endif
                        </div>
                        @foreach($categories as $category)
                            <div class="tab-pane fade" id="target_category_{{$category['id']}}" role="tabpanel" aria-labelledby="category_{{$category['id']}}">
                                @if(count($category['products']) > 0)
                                    <div class="row">
                                        <div class="col-md-12 col-lg-12">
                                            <div class="row">
                                                @foreach($category['products'] as $index=>$product)
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

                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <div class="col-md-12 col-lg-4">
                        @if(!is_null($cart))
                        <div id="carts">
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
                                                    <input class="product-qty ss" disabled type="text" name="product-qty"
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
                        </div>
                        @else
                            <div id="carts">
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
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
  @include('website.layout.modal')
@endsection
@section('script')
    <script src="{{asset('')}}assets/website/js/index.js"></script>

    <script>

        $(window).ready(function () {
            $( ".open_product_modal" ).on( "click", function() {
                var product = $(this).data('product');
                var product_photo = $(this).data('product_photo');
                var max_addons = product.max_addons;
                var addons_html = ``;
                console.log("product",$(this).data('product'))
                if(product.product_addons.length > 0){
                    product.product_addons.forEach(function(addon) {
                        addons_html+=`
                         <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <input type="checkbox" name="selected_addons[]" value="${addon.id}"  class="addon_check">
                                <label for="don" class="fs-4 pe-2">${addon.name}</label>
                            </div>
                            <div>
                                <div class="qty-input">
                                    <button class="qty-count qty-count--add ad" disabled data-action="add" type="button">
                                        <span class="text-white">+</span></button>
                                    <input class="product-qty" type="text" name="product-qty" value="1" disabled>
                                    <button class="qty-count qty-count--minus mi " data-action="minus" type="button">-</button>
                                </div>
                            </div>
                        </div>`
                    });
                }
                $('#check_box').html(addons_html)
                $('#name_modal').html(product.name)
                $('#description_modal').html(product.description)
                // $('#modal-box-button').html( product.price_after_discount+'ريال ')
                if(product.max_addons > 0){
                    $('#max_addons').html( product.max_addons)
                }else{
                    $('#parent_addon').remove()
                }
                $('#photo_modal').css("background-image", "url(" + product_photo + ")");
                $('#modal-subscribe').modal("show")


                var addon_ids = [];


                $('.addon_check').on( "click", function() {
                    var add_btn = $(this).parent().parent().find('.ad');
                    var mi_btn = $(this).parent().parent().find('.mi');
                    if($(this).is(":checked")){
                        add_btn.prop("disabled", false)
                        mi_btn.prop("disabled", false)
                    }else{
                        add_btn.prop("disabled", true)
                        mi_btn.prop("disabled", true)
                        $(this).parent().parent().find('.product-qty').val(1)
                    }

                    isGreaterThanMaxAddons(max_addons)

                })
                function  isGreaterThanMaxAddons(max_addons){
                    var qty = 0;
                    addon_ids = [];
                    $('.addon_check').each(function() {
                        if($(this).is(":checked")){
                            qty += parseInt($(this).parent().parent().find('.product-qty').val());
                            addon_ids.push($(this).val());
                        }
                    });
                    if(qty >= max_addons ){
                        $('.addon_check').each(function() {
                            if(!$(this).is(":checked")){
                                $(this).attr('disabled','false');
                            }

                        });
                        return true;
                    }
                    $('.addon_check').each(function() {
                        $(this).prop("disabled", false);
                    });
                    return false;
                }
                //On click add 1 to n
                $('.qty-count--add').on('click', function(){
                    var qty_input = $(this).parent().find('.product-qty');
                    var qty =   parseInt(qty_input.val());
                    if(!isGreaterThanMaxAddons(max_addons))
                         qty_input.val(qty+1)
                    isGreaterThanMaxAddons(max_addons)

                })
                //On click minus 1 to n
                $('.qty-count--minus').on('click', function(){
                    var qty_input = $(this).parent().find('.product-qty');
                    var qty =   parseInt(qty_input.val());
                    if(qty <= max_addons && qty!=1){
                        qty_input.val(qty-1)
                    }

                    isGreaterThanMaxAddons(max_addons)
                })



                //add to cart
                $('#modal-box-button').on( "click", function() {
                    var product_qty = parseInt($('#product_qty').html());
                    axios.post('{{route('add-to-cart')}}',{product_id:product.id,product_qty:product_qty}).then(function (response) {
                        if(response.data.data){
                            $('#carts').html(response.data.data)
                            $('#modal-subscribe').modal("hide")
                        }
                    })

                    })


            });




        })
    </script>
@endsection
