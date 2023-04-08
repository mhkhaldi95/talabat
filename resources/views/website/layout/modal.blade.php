<!-- the Section End model -->


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
            <div class="modal-body" style="text-align: center">
                <div id="countDownWebsite-modal-body">

                </div>
            </div>
        </div>
        <!-- Modal footer -->
    </div>
</div>



<!-- The you rName Modal -->
<div class="modal" id="yourNameModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->

            <!-- Modal body -->
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

                <p class="text-center color-low-dark mb-5">complete registeration</p>
                <div class="input-group flex-nowrap mb-3">
                    <input type="text" class="form-control bg-gray name-input" placeholder="Username"
                           aria-label="Username"
                           aria-describedby="addon-wrapping">
                </div>
                <button class="w-100 btn  bg-main py-2">
                    done
                </button>
            </div>
        </div>
        <!-- Modal footer -->
    </div>
</div>

<!-- The verification Modal -->
<div class="modal" id="verificationModal">
    <div class="modal-dialog">
        <div class="modal-content phone-verification">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="container height-100 d-flex justify-content-center align-items-center">
                    <div class="position-relative">
                        <div class=" p-2 text-center">
                            <p class="text-center color-low-dark">Enter the verification code sent to your number</p>
                            <div id="otp" class="inputs d-flex flex-row justify-content-center mt-2">
                                <input class="m-2 code-input text-center form-control rounded bg-gray" type="text"
                                       id="first" maxlength="1">
                                <input class="m-2 code-input text-center form-control rounded bg-gray" type="text"
                                       id="second" maxlength="1">
                                <input class="m-2 code-input text-center form-control rounded bg-gray" type="text"
                                       id="third" maxlength="1">
                                <input class="m-2 code-input text-center form-control rounded bg-gray" type="text"
                                       id="fourth" maxlength="1">
                                <input class="m-2 code-input text-center form-control rounded bg-gray" type="text"
                                       id="fifth" maxlength="1">
                                <input class="m-2 code-input text-center form-control rounded bg-gray" type="text"
                                       id="sixth" maxlength="1">
                            </div>
                            <a href="#" class="text-decoration-underline ms-3  color-low-dark">Resend the code</a>

                            <div class="mt-4">
                                <button class="btn  bg-main px-4 validate w-100" data-bs-toggle="modal"
                                        data-bs-target="#yourNameModal">Validate
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal footer -->
</div>

<!-- The product Modal -->
<div class="modal" id="productModal">
    <div class="modal-dialog product-model-dialog">
        <div class="modal-content ">
            <!-- Modal Header -->

            <!-- Modal body -->
            <div class="modal-body product-model-body">
                <div class=" mb-3">
                    <div class="top-img position-relative">
                        <img id="photo_modal" src="{{asset('')}}assets/website/images/product.png" class="card-img-top"
                             alt="product">
                        <div class="card-img-overlay product-model-overlay">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                    </div>

                    <div class="card-body  text-center">
                        <h5 class="mb-3" data-i18n="productName" id="name_modal">donats</h5>
                        <span class="color-low-dark " data-i18n="productText" id="description_modal"
                              style="font-size: 14px;">
                            Some quick example text to build on
                            the card title and
                            make up the bulk of the card's content.
                          </span>


                    </div>

                    <div class="d-flex align-items-center justify-content-center">

                        <div class="d-flex justify-content-center align-items-center h-100 ">
                            <button class="btn w25 bg-main increment plus" fdprocessedid="5l4yfr">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                            <span id="product_qty" class="counter-container num">01</span>
                            <button class="btn w25 decrement minus" fdprocessedid="4aox6r">
                                <i class="fa-solid fa-minus"></i>
                            </button>

                        </div>

                        <a href="#" class="btn btn-product w-50 mx-3 p-2 " id="modal-box-button">
                            <span class="mx-1" data-i18n="productPrice"><span id="price_modal"></span> ريال</span>
                            <img src="{{asset('')}}assets/website/images/sal-i.png" alt="" class="w-20px">
                        </a>

                    </div>
                </div>


            </div>
        </div>
        <!-- Modal footer -->
    </div>
</div>


<!-- The invoice Modal -->
<div class="modal" id="invoice">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->

            <!-- Modal body -->
            <div class="modal-body" id="invoice-modal-body">


            </div>

        </div>
        <!-- Modal footer -->
    </div>
</div>

<!--  completed Modal -->
<div class="modal" id="completed">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <!-- Modal body -->
            <div class="modal-body">

                <p class="login-text ">completed order</p>

                <div class="done-img text-center">
                    <img src="assets/images/icons/تمت العملية.svg" alt="">
                </div>

                <button class="w-100 btn p-2 bg-main">
                    done
                </button>
            </div>
        </div>
        <!-- Modal footer -->
    </div>
</div>
<!-- bootstrap js cdns -->


<div class="modal" id="loginModal">
    <div class="modal-dialog">
        <div class="modal-content" id="modal-content">
            <!-- Modal Header -->
            <div class="modal-header" >
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body" >
                <p class="login-text">{{__('login or register')}}</p>

                <div class="w-100 phone-input my-3 ">
                    <input class="form-control bg-gray p-2" name="phone" type="text" id="phone"
                           placeholder="phone number"/>


                </div>



                <div style="padding-right: 9%" id="mobile_hide" class="selector_hide">
                    <span class="text-danger hide "> يجب ادخال رقم الجوال</span>
                </div>
                <button class="w-100 btn p-2 bg-main" id="modal-mobile-login-next">
                    Next
                </button>
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
<script>
    var input = document.querySelector("#phone");
    window.intlTelInput(input, {
        separateDialCode: true,
        excludeCountries: ["in", "il"],
        preferredCountries: ["ru", "jp", "pk", "no"]
    });
</script>
