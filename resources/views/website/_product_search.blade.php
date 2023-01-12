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
