
<!-- the Section End model -->


<div class="modal productModal" id="productModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="product-item">
                    <div class="card h-100 w-100">
                        <img id="photo_modal" src="{{asset('')}}assets/website/images/product.png" class="card-img-top" alt="product">
                        <div class="card-body text-center">
                            <h5 class="card-title" data-i18n="productName" id="name_modal">donats</h5>
                            <p class="card-text" data-i18n="productText" id="description_modal">
                                Some quick example text to build on
                                the card title and
                                make up the bulk of the card's content.
                            </p>
                        </div>
                        <div id="addons">

                        </div>

                        <div class="d-flex align-items-center justify-content-center">
                            <div class="d-flex justify-content-center align-items-center h-100 p-3">
                                <button class="btn w25 bg-main increment plus"  fdprocessedid="5l4yfr">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                                <span id="product_qty" class="counter-container num">01</span>
                                <button class="btn w25 decrement minus"  fdprocessedid="4aox6r">
                                    <i class="fa-solid fa-minus"></i>
                                </button>
                            </div>
                            <div class="w-100">
                                <a href="#" class="btn btn-product w-100 " id="modal-box-button">
                                    <span class="mx-1" data-i18n="productPrice"><span id="price_modal"></span> ريال</span>
                                    <img src="{{asset('')}}assets/website/images/sal-i.png" alt="" class="w-20px">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal footer -->
    </div>
</div>

<div class="modal" id="loginModal">
    <div class="modal-dialog">
        <div class="modal-content" id="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <p>{{__('login or register')}}</p>

                <div class="w-100 phone-input my-2">
                    <input class="form-control " name="phone" type="text" id="phone" />

                </div>
                <div style="padding-right: 9%" id="mobile_hide"  class="selector_hide">
                    <span class="text-danger hide "> يجب ادخال رقم الجوال</span>
                </div>
                <button class="w-100 btn  bg-main" id="modal-mobile-login-next" >
                    Next
                </button>
            </div>
        </div>
        <!-- Modal footer -->
    </div>
</div>
<div class="modal" id="invoice">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body" id="invoice-modal-body">


            </div>
        </div>
        <!-- Modal footer -->
    </div>
</div>
<div class="modal" id="countDownWebsite">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
            </div>
            <!-- Modal body -->
            <div class="modal-body" style="text-align: center" >
                <div id="countDownWebsite-modal-body">

                </div>
            </div>
        </div>
        <!-- Modal footer -->
    </div>
</div>
<div class="modal" id="countDown">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
            </div>
            <!-- Modal body -->
            <div class="modal-body" style="text-align: center" >
                <div id="countDown-modal-body">

                </div>
                <input type="hidden" id="modal_order_id"/>
                <input type="hidden" id="modal_branch_id"/>

            </div>
            <div class="modal-footer">
                <button type="button" id="accept_order" class="btn btn-primary">قبول</button>
                <button type="button" id="reject_order" class="btn btn-danger" >رفض</button>
            </div>
        </div>
        <!-- Modal footer -->
    </div>
</div>

