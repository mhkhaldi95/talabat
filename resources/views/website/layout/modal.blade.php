<!-- the Section Start model -->
<div class="modal fade" id="modal-subscribe" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content" >

            <div class="modal-body">
                <div class="image">
                    <div class="bg-img" id="photo_modal">

                    </div>
                </div>
                <i class="fa-solid fa-rectangle-xmark  icon-model" data-bs-dismiss="modal" aria-label="Close"></i>
                <div class="img-model">
                    <!-- <img src="img/Screenshot 2022-12-08 at 1.36.33 PM.png" alt=""> -->
                </div>
                <div class="text-center p-3 text-model">
                    <p id="name_modal">

                    </p>
                    <p class="text-muted fs-5 py-4"  id="description_modal">

                    </p>
                    <div class="box-tiem-3 " id="parent_addon">
                        <p class="text-center fs-3 text-muted"> النكهات</p>
                        <small>بحد أقصى <span id="max_addons"></span></small>
                        <div id="check_box">

                        </div>

                    </div>
                    <div class="d-flex align-items-center pt-4">
                        <div class="quan d-flex mx-2">
                            <span class="plus"><i class="fa-solid fa-plus pl-icon"></i></span>
                            <span class="num" id="product_qty"></span>
                            <span class="minus"><i class="fa-solid fa-minus pl-icon"></i></span>
                        </div>
                        <button class="box-button fs-5 " id="modal-box-button">
                            {{__('lang.add')}}
                            <i class="fa-brands fa-shopify"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- the Section End model -->
