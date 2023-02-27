<script>
    // const audio = new Audio('https://waveform.customer.envato.com/tsunami/156322809/preview.mp3');
    // audio.play();
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        @if(app()->getLocale() == 'ar')
        "positionClass": "toast-top-left",
        @else
        "positionClass": "toast-top-right",
        @endif
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    @if(Session::has('message'))
    var type = "{{Session::get('alert-type','info')}}"
    switch (type) {
        case 'info':
            toastr.info("{{Session::get('message') }}");
            break;
        case 'success':
            toastr.success("{{Session::get('message') }}");
            break;
        case 'warning':
            toastr.warning("{{Session::get('message') }}");
            break;
        case 'error':
            toastr.error("{{Session::get('message') }}");
            break;
    }
    @endif
    $(window).ready(function () {


        $("#product_search" ).on("keyup", function(event) {
            axios.post('{{route('products.filter')}}',{search:event.target.value,branch_id:"{{@$branch->id}}"}).then(function (response) {
                if(response.data.data){
                    $('#products').html(response.data.data.products)
                }
            })
        });


        var product = null;
        var product_photo = null;
        var max_addons = null;
        var addons_html = ``;
        var addon_ids = [];
        var qty_addons = [];
        $(document).on('click','.open_product_modal',function (e) {
            // play()

            product = $(this).data('product');
            product_photo = $(this).data('product_photo');
            max_addons = product.max_addons;
            addons_html = ``;
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
            $('#product_hidden').val(product)
            $('#description_modal').html(product.description)
            if(product.max_addons > 0){
                $('#max_addons').html( product.max_addons)
            }else{
                $('#parent_addon').remove()
            }
            $('#photo_modal').css("background-image", "url(" + product_photo + ")");
            $('#modal-subscribe').modal("show")




            $(document).on('click','.addon_check',function (e) {
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
                qty_addons = [];
                $('.addon_check').each(function() {
                    if($(this).is(":checked")){
                        qty_addon = parseInt($(this).parent().parent().find('.product-qty').val());
                        qty += parseInt($(this).parent().parent().find('.product-qty').val());
                        addon_ids.push($(this).val());
                        qty_addons.push(qty_addon);
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
            $(document).on('click','.qty-count--add',function (e) {
                var qty_input = $(this).parent().find('.product-qty');
                var qty =   parseInt(qty_input.val());
                if(!isGreaterThanMaxAddons(max_addons))
                    qty_input.val(qty+1)
                isGreaterThanMaxAddons(max_addons)

            })
            //On click minus 1 to n
            $(document).on('click','.qty-count--minus',function (e) {
                var qty_input = $(this).parent().find('.product-qty');
                var qty =   parseInt(qty_input.val());
                if(qty <= max_addons && qty!=1){
                    qty_input.val(qty-1)
                }

                isGreaterThanMaxAddons(max_addons)
            })





        });

        $(document).on('click','.qty-count--add-in-cart',function (e) {
            var qty = parseInt($(this).parent().find("input").val())+1;
                var product = $(this).data('product')
                $(this).parent().find("input").val(qty)
                axios.post('{{route('add-to-cart')}}',{product_id:product.id,product_qty:qty,plus_one:true,branch_id:"{{@$branch->id}}"}).then(function (response) {
                    if(response.data.data){
                        $('#carts').html(response.data.data)
                        toastr.success("تمت الاضافة الى السلة بنجاح");
                    }

                })


        })
        $(document).on('click','.qty-count--minus-in-cart',function (e) {
            var qty = parseInt($(this).parent().find("input").val())-1;
            if(qty<1){
                qty = 1
                $(this).parent().find("input").val(qty)
                return;
            }
            var product = $(this).data('product')

            axios.post('{{route('minus')}}',{product_id:product.id,product_qty:qty,minus_one:true,branch_id:"{{@$branch->id}}"}).then(function (response) {
                if(response.data.data){
                    $('#carts').html(response.data.data)
                }
            })
        })
        $(document).on('click','.delete_from_cart',function (e) {
            var id = $(this).data('id')
            axios.post('{{route('delete-from-cart')}}',{product_id:id,branch_id:"{{@$branch->id}}"}).then(function (response) {
                if(response.data.data){
                    $('#carts').html(response.data.data)
                }
            })
        })




        $(document).on('click','#complete_order',function (e) {
            $('#mobile_hide').removeClass( "selector_show" ).addClass( "selector_hide" );
            $('#modal-mobile-login').modal("show")
        })

        $(document).on('click','#customer_login',function (e) {
            $('#mobile_hide').removeClass( "selector_show" ).addClass( "selector_hide" );
            $('#modal-mobile-login').modal("show")
        })





        $(document).on('click','#modal-mobile-login-next',function (e) {
            var phone =  $('#modal-mobile-input').val();
            if(!phone || phone == ''){
                $('#mobile_hide').removeClass( "selector_hide" ).addClass( "selector_show" );
                return;
            }
            axios.post('{{route('check-phone')}}',{phone:phone}).then(response => {
                if(response.data.data.phone){
                    localStorage.setItem("phone",response.data.data.phone)
                    localStorage.setItem("is_new",response.data.data.is_new)
                    $('#modal-content').html(response.data.data.check_code_modal)
                }

            }).catch(error => {

            });

        })


        //add to cart
        $(document).on('click','#modal-box-button',function (e) {
            var product_qty = parseInt($('#product_qty').html());
                axios.post('{{route('add-to-cart')}}',{product_id:product.id,product_qty:product_qty,qty_addons:qty_addons,addon_ids:addon_ids,branch_id:"{{@$branch->id}}"}).then(function (response) {
                    if(response.data.data){
                        $('#carts').html(response.data.data)
                        $('#modal-subscribe').modal("hide")
                        toastr.success("تمت الاضافة الى السلة بنجاح");
                    }


        })

        $(document).on('click','#modal-check-code-next',function (e) {
            var check_input_1 =  $('#check_input_1').val();
            var check_input_2 =  $('#check_input_2').val();
            var check_input_3 =  $('#check_input_3').val();
            var check_input_4 =  $('#check_input_4').val();
            var check_input_5 =  $('#check_input_5').val();
            if(
                !check_input_1 || check_input_1 == '' ||
                !check_input_2 || check_input_2 == '' ||
                !check_input_3 || check_input_3 == '' ||
                !check_input_4 || check_input_4 == '' ||
                !check_input_5 || check_input_5 == ''
            ){
                $('#mobile_hide').removeClass( "selector_hide" ).addClass( "selector_show" );
                return;
            }
            var code = check_input_1+check_input_2+check_input_3+check_input_4+check_input_5
            axios.post('{{route('checkCodeSms')}}',{phone:localStorage.getItem('phone'),code:code,branch_id:"{{@$branch->id}}"}).then(response => {
                if( response.data.data && localStorage.getItem("is_new")){
                    $('#modal-content').html(response.data.data.complete_register_name)

                }else{
                    localStorage.setItem("phone",null)
                    localStorage.setItem("is_new",null)
                    toastr.success("تم تسجيل الدخول بنجاح");
                    setTimeout(function (){
                        window.location.reload()
                    }, 1500)
                }

            }).catch(error => {

            });

        })

        $(document).on('click','#resendCodeSms',function (e) {
            axios.post('{{route('resendCodeSms')}}',{phone:localStorage.getItem('phone')}).then(response => {
                if(response.data.status)
                    toastr.success(response.data.message);
                else
                    toastr.error(response.data.message);

            }).catch(error => {

            });

        })

        $(document).on('click','#modal-enter-name-done',function (e) {
            var name =  $('#name').val();
            if(
                !name || name == ''
            ){
                $('#name_hide').removeClass( "selector_hide" ).addClass( "selector_show" );
                return;
            }
            axios.post('{{route('customer-complete-register')}}',{phone:localStorage.getItem('phone'),name:name}).then(response => {
                localStorage.setItem("phone",null)
                localStorage.setItem("is_new",null)
                $('#modal-subscribe').modal("hide")
                toastr.success("تم تسجيل الدخول بنجاح");
                setTimeout(function (){
                    window.location.reload()
                }, 1500)
            }).catch(error => {
                toastr.success("Login Failed");
            });

        })

        // $('#audio').play()




    })
    });
    // function  play(){
    //     var aud = document.getElementById("audio");
    //     aud.play()
    // }
</script>
