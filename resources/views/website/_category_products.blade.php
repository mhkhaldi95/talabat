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
