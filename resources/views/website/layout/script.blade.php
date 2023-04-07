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


        $("#product_search").on("keyup", function (event) {
            axios.post('{{route('products.filter')}}', {
                search: event.target.value,
                branch_id: "{{@$branch->id}}"
            }).then(function (response) {
                if (response.data.data) {
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
        $(document).on('click', '.open_product_modal', function (e) {
            // play()
            e.preventDefault()
            product = $(this).data('product');
            product_photo = $(this).data('product_photo');
            max_addons = product.max_addons;
            addons_html = ` <h3 class="text-center ">flavours </h3>`;
            if (product.product_addons.length > 0) {
                product.product_addons.forEach(function (addon) {
                    addons_html += `

                        <div class=" my-2 row align-items-center">

                              <div class="col-6  d-flex align-items-center">
                                <div class="">
                                    <input class="form-check-input mt-0 addon_check" type="checkbox" name="selected_addons[]" value="${addon.id}"
                                    aria-label="Checkbox for following text input">
                              </div>

                                <div class="px-2 mb-2 text-break">${addon.name}</div>
                              </div>
                              <div class="d-flex justify-content-center align-items-center h-50 col-6">
                               <button class="btn w25 bg-main increment qty-count qty-count--add ad" disabled  fdprocessedid="5l4yfr"
                                            style="font-size: 10px;">
                                        <i class="fa-solid fa-plus"></i>
                               </button>
                                <span id="root" class="counter-container product-qty">0</span>
                                 <button class="btn w25 btn-outline-danger qty-count qty-count--minus mi " disabled  fdprocessedid="4aox6r"
                                            style="font-size: 10px;">
                                        <i class="fa-solid fa-minus fa-sm"></i>
                                 </button>
                              </div>
                        </div>




`
                });
            }


            $('#addons').html(addons_html)
            $('#name_modal').html(product.name)
            $('#product_hidden').val(product)
            $('#price_modal').html(product.price)
            $('#description_modal').html(product.description)
            // if(product.max_addons > 0){
            //     $('#max_addons').html( product.max_addons)
            // }else{
            //     $('#parent_addon').remove()
            // }
            $('.product-item #photo_modal').attr("src", product_photo);
            // $('#photo_modal').css("background-image", "url(" + product_photo + ")");
            // $("#productModal").modal({ backdrop: "static ", keyboard: false });
            $('#productModal').modal("show")



            $(".addon_check").click( function (e) {
                // e.preventDefault()

                var add_btn = $(this).parent().parent().parent().find('.ad');
                var mi_btn = $(this).parent().parent().parent().find('.mi');
                if ($(this).is(":checked")) {
                    add_btn.prop("disabled", false)
                    mi_btn.prop("disabled", false)
                    $(this).parent().parent().parent().find('.product-qty').html(1)
                } else {
                    add_btn.prop("disabled", true)
                    mi_btn.prop("disabled", true)
                    $(this).parent().parent().parent().find('.product-qty').html(0)
                }

                isGreaterThanMaxAddons(max_addons)

            })

            function isGreaterThanMaxAddons(max_addons) {
                var qty = 0;
                addon_ids = [];
                qty_addons = [];

                $('.addon_check').each(function () {

                    if ($(this).is(":checked")) {
                        qty_addon = parseInt($(this).parent().find('.product-qty').html());
                        qty += parseInt($(this).parent().find('.product-qty').html());
                        addon_ids.push($(this).val());
                        qty_addons.push(qty_addon);
                    }
                });
                if (qty >= max_addons) {
                    $('.addon_check').each(function () {
                        if (!$(this).is(":checked")) {
                            $(this).attr('disabled', 'false');
                        }

                    });
                    return true;
                }
                $('.addon_check').each(function () {
                    $(this).prop("disabled", false);
                });
                return false;
            }

            //On click add 1 to n
            $(".qty-count--add").click( function (e) {

                var qty_input = $(this).parent().find('.product-qty');
                var qty = parseInt(qty_input.html());
                if (!isGreaterThanMaxAddons(max_addons))
                    qty_input.html(qty + 1)
                isGreaterThanMaxAddons(max_addons)

            })
            //On click minus 1 to n
            $('.qty-count--minus').click(function (e) {
                var qty_input = $(this).parent().find('.product-qty');
                var qty = parseInt(qty_input.html());
                if (qty <= max_addons && qty != 1) {
                    qty_input.html(qty - 1)
                }

                isGreaterThanMaxAddons(max_addons)
            })


        });
        $(document).on('hidden.bs.modal', '#productModal', function () {
            $('#productModal').trigger('reset')
        })
        $(document).on('click', '.qty-count--add-in-cart', function (e) {
            var qty = parseInt($(this).parent().find("span").html()) + 1;
            var product = $(this).data('product')
            $(this).parent().find("span").html(qty)
            axios.post('{{route('add-to-cart')}}', {
                product_id: product.id,
                product_qty: qty,
                plus_one: true,
                branch_id: "{{@$branch->id}}"
            }).then(function (response) {
                if (response.data.data) {
                    $('#carts').html(response.data.data)
                    toastr.success("تمت الاضافة الى السلة بنجاح");
                }

            })


        })
        $(document).on('click', '.qty-count--minus-in-cart', function (e) {
            var qty = parseInt($(this).parent().find("span").html()) - 1;
            if (qty < 1) {
                qty = 1
                $(this).parent().find("span").html(qty)
                return;
            }
            var product = $(this).data('product')

            axios.post('{{route('minus')}}', {
                product_id: product.id,
                product_qty: qty,
                minus_one: true,
                branch_id: "{{@$branch->id}}"
            }).then(function (response) {
                if (response.data.data) {
                    $('#carts').html(response.data.data)
                }
            })
        })
        $(document).on('click', '.delete_from_cart', function (e) {
            var id = $(this).data('id')
            axios.post('{{route('delete-from-cart')}}', {
                product_id: id,
                branch_id: "{{@$branch->id}}"
            }).then(function (response) {
                $('#carts').html(response.data.data)
            })
        })


        $(document).on('click', '#complete_order', function (e) {
            $('#mobile_hide').removeClass("selector_show").addClass("selector_hide");
            $('#loginModal').modal("show")
        })


        $(document).on('click', '#customer_login', function (e) {
            $('#mobile_hide').removeClass("selector_show").addClass("selector_hide");

            $('#loginModal').modal("show")
        })


        $(document).on('click', '#modal-mobile-login-next', function (e) {
            var phone = $('#phone').val();
            if (!phone || phone == '') {
                toastr.warning("تأكد من رقم الجوال")
                // $('#mobile_hide').removeClass( "selector_hide" ).addClass( "selector_show" );
                return;
            }
            axios.post('{{route('check-phone')}}', {phone: phone}).then(response => {
                if (response.data.data.phone) {
                    localStorage.setItem("phone", response.data.data.phone)
                    localStorage.setItem("is_new", response.data.data.is_new)
                    $('#modal-content').html(response.data.data.check_code_modal)
                }

            }).catch(error => {

            });

        })


        //add to cart
        $(document).on('click', '#modal-box-button', function (e) {
            var product_qty = parseInt($('#product_qty').html());
            axios.post('{{route('add-to-cart')}}', {
                product_id: product.id,
                product_qty: product_qty,
                qty_addons: qty_addons,
                addon_ids: addon_ids,
                branch_id: "{{@$branch->id}}"
            }).then(function (response) {
                if (response.data.data) {
                    $('#carts').html(response.data.data)
                    $('#productModal').modal("hide")
                    toastr.success("تمت الاضافة الى السلة بنجاح");
                }


            })

            $(document).on('click', '#modal-check-code-next222', function (e) {
                console.log("111111111")
                var check_input_1 = $('#check_input_1').val();
                var check_input_2 = $('#check_input_2').val();
                var check_input_3 = $('#check_input_3').val();
                var check_input_4 = $('#check_input_4').val();
                var check_input_5 = $('#check_input_5').val();
                if (
                    !check_input_1 || check_input_1 == '' ||
                    !check_input_2 || check_input_2 == '' ||
                    !check_input_3 || check_input_3 == '' ||
                    !check_input_4 || check_input_4 == '' ||
                    !check_input_5 || check_input_5 == ''
                ) {
                    $('#mobile_hide').removeClass("selector_hide").addClass("selector_show");
                    return;
                }
                console.log("X")
                var code = check_input_1 + check_input_2 + check_input_3 + check_input_4 + check_input_5
                axios.post('{{route('checkCodeSms')}}', {
                    phone: localStorage.getItem('phone'),
                    code: code,
                    branch_id: "{{@$branch->id}}"
                }).then(response => {
                    if (response.data.data && localStorage.getItem("is_new")) {
                        $('#modal-content').html(response.data.data.complete_register_name)

                    } else {
                        localStorage.setItem("phone", null)
                        localStorage.setItem("is_new", null)
                        toastr.success("تم تسجيل الدخول بنجاح");
                        setTimeout(function () {
                            window.location.reload()
                        }, 1500)
                    }

                }).catch(error => {

                });

            })

            $(document).on('click', '#resendCodeSms', function (e) {
                axios.post('{{route('resendCodeSms')}}', {phone: localStorage.getItem('phone')}).then(response => {
                    if (response.data.status)
                        toastr.success(response.data.message);
                    else
                        toastr.error(response.data.message);

                }).catch(error => {

                });

            })

            $(document).on('click', '#modal-enter-name-done', function (e) {
                console.log("X")
                var name = $('#name').val();
                if (
                    !name || name == ''
                ) {
                    $('#name_hide').removeClass("selector_hide").addClass("selector_show");
                    return;
                }
                axios.post('{{route('customer-complete-register')}}', {
                    phone: localStorage.getItem('phone'),
                    name: name
                }).then(response => {
                    localStorage.setItem("phone", null)
                    localStorage.setItem("is_new", null)
                    $('#modal-subscribe').modal("hide")
                    toastr.success("تم تسجيل الدخول بنجاح");
                    setTimeout(function () {
                        window.location.reload()
                    }, 1500)
                }).catch(error => {
                    toastr.success("Login Failed");
                });

            })

            // $('#audio').play()


        })
        $(document).on('click', '#completion_coupon', function (e) {


            var code = $('#coupon_value').val();
            var branch_id = $(this).data('branch-id');
            if (
                !code || code == ''
            ) {
                toastr.warning("أدخل الكود بشكل صحيح");
                return;
            }
            var url = '{{ route("check.coupon", ":id") }}';
            url = url.replace(':id', code);
            url = url + "?branch_id=" + branch_id;
            axios.post(url).then(response => {
                $('#carts').html(response.data.data)
                toastr.success("تم تطبيق الكوبون بنجاح");
            }).catch(error => {
                toastr.warning("أدخل الكود بشكل صحيح");
            });

        })

        $(document).on('click', '.next_branch', function (e) {
            var branch_id = $('#branch_form input[type=radio]:checked').val();
            if (branch_id) {
                goToUrl('/products?branch_id=' + branch_id)
            } else {
                toastr.warning("يجب أن تختار الفرع");
            }

        })


        $(document).on('click', '.plus', function (e) {
            var num = $('#product_qty');
            a = parseInt(num.html());
            a++;
            a = (a < 10) ? "0" + a : a;
            localStorage.setItem("num", a);
            num.html(localStorage.getItem("num"));

        })

        $(document).on('click', '.minus', function (e) {
            var num = $('#product_qty');
            a = parseInt(num.html());

            if (a > 1) {
                a--;
                a = (a < 10) ? "0" + a : a;
                localStorage.setItem("num", a);
                num.html(localStorage.getItem("num"));
            }

        })



        $(document).off('click', '#openModalInvoice').on('click', '#openModalInvoice',function (e) {
            var url = "{{route('orderInfo')}}";
            var url = url+"?branch_id="+getBranch()
            axios.get(url,{branch_id:getBranch()}).then(response => {
                $('#invoice-modal-body').html(response.data.data)
            }).catch(error => {
                toastr.warning("حدث خطا ما");
            });
            $('#invoice').modal("show")
        })


        $(document).on('click', '#online-payment', function (e) {

            goToUrl('/payment?payment_method=online&branch_id=' + branch_id)
            $('#invoice').modal("hide")
        })
        $(document).on('click', '#cashBack-payment', function (e) {
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            var branch_id = urlParams.get('branch_id')

            axios.get('{{route('checkCashback')}}').then(response => {
                if(response.data.status){
                    goToUrl('/payment?payment_method=cashBack&branch_id=' + branch_id)
                    $('#invoice').modal("hide")
                }else{
                    toastr.warning("رصيدك لا يكفي");
                }

            }).catch(error => {
                toastr.warning("حدث خطا ما");
            });

            // goToUrl('/payment?payment_method=cashBack&branch_id=' + branch_id)
            // $('#invoice').modal("hide")
        })
        $(document).off('click', '#cash-payment').on('click', '#cash-payment',function (e) {
            axios.post("{{route('orders.store')}}",{branch_id:getBranch(),payment_method:'cash'}).then(response => {
                if(response.data.status){
                    $('#invoice').modal("hide")
                    countDown(response.data.data.order)
                    $('#carts').html(response.data.data.cart)
                }else{
                    toastr.warning(response.data.message);
                }
            }).catch(error => {
                alert(error.message)
                toastr.warning(error.message);
            });

        })



        function  countDown(order){
            $('#modal_order_id').val(order.id)
            $('#modal_branch_id').val(getBranch())

            $("#countDownWebsite").modal({ backdrop: "static ", keyboard: false });
            $('#countDownWebsite').modal('show')
            var countDownDate = 30;
            document.getElementById("countDownWebsite-modal-body").innerHTML = countDownDate+'<br/>سيتم قبول طلبك تلقائيا بعد 30 ثانية';

            var x = setInterval(function() {
                countDownDate = countDownDate - 1;
                document.getElementById("countDownWebsite-modal-body").innerHTML = countDownDate+'<br/>سيتم قبول طلبك تلقائيا بعد 30 ثانية';
                if(countDownDate <= 0){
                    clearInterval(x);
                    axios.post("{{route('orders.accept')}}",{
                            order_id: order.id,
                            branch_id:getBranch()
                    }).then(response => {
                        $('#countDownWebsite').modal('hide')
                        toastr.success("تم قبول الطلبية بنجاح");
                    }).catch(error => {
                        toastr.warning("حدث خطا ما");
                    });
                }


            }, 1000);
            window.onbeforeunload = function() {
                return "Dude, are you sure you want to leave? Think of the kittens!";
            }
        }
        function getBranch(){
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            var branch_id = urlParams.get('branch_id')
            return branch_id;
        }

        $(document).off('click', '#accept_order').on('click', '#accept_order', function (e) {

            var order_id = $('#modal_order_id').val()
            var branch_id = $('#modal_branch_id').val()
            if(order_id && branch_id){
                axios.post("{{route('branch.orders.accept')}}",{
                    order_id: order_id,
                    branch_id:getBranch()
                }).then(response => {
                    $('#countDownWebsite').modal('hide')
                    $('#countDown').modal('hide')
                    toastr.success("تم قبول الطلبية بنجاح");
                }).catch(error => {
                    toastr.warning("حدث خطا ما");
                });
            }else{
                toastr.warning("حدث خطا ما");
            }


        })
        $(document).on('click', '#reject_order', function (e) {

            alert("X")
            var order_id = $('#modal_order_id').val()
            var branch_id = $('#modal_branch_id').val()
            if(order_id && branch_id){
                axios.post("{{route('branch.orders.reject')}}",{
                    order_id: order_id,
                    branch_id:getBranch()
                }).then(response => {
                    $('#countDownWebsite').modal('hide')
                    $('#countDown').modal('hide')
                    toastr.warning("تم رفض طلبيتك ");
                }).catch(error => {
                    toastr.warning("حدث خطا ما");
                });
            }else{
                toastr.warning("حدث خطا ما");
            }


        })


    });
    // function  play(){
    //     var aud = document.getElementById("audio");
    //     aud.play()
    // }
</script>
<script type="text/javascript">

    function handleSelect(elm) {
        window.location = elm.value;
    }

    function goToUrl(url) {
        window.location.href = url
        // window.open(url, '_blank');
    }
</script>
