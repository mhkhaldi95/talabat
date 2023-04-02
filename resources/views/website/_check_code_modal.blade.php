
<!-- Modal Header -->
<div class="modal-header">
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>
<!-- Modal body -->
<div class="modal-body">
    <div class="container height-100 d-flex justify-content-center align-items-center">
        <div class="position-relative">
            <div class="card p-2 text-center">
                <p class="text-center"> ادخل كود التحقق المرسل لرقمك{{$phone}}</p>
                <div id="otp" class="inputs d-flex flex-row justify-content-center mt-2">
                    <input class="m-2 text-center form-control rounded" type="text" id="check_input_1" maxlength="1">
                    <input class="m-2 text-center form-control rounded" type="text" id="check_input_2" maxlength="1">
                    <input class="m-2 text-center form-control rounded" type="text" id="check_input_3" maxlength="1">
                    <input class="m-2 text-center form-control rounded" type="text" id="check_input_4" maxlength="1">
                    <input class="m-2 text-center form-control rounded" type="text" id="check_input_5" maxlength="1">
                </div>
                <div style="padding-right: 9%" id="mobile_hide"  class="selector_hide">
                    <span class="text-danger hide "> أدخل الكود كاملا </span>
                </div>
                <div class="mt-4">
                    <button class="btn  bg-main px-4 validate w-100" id="modal-check-code-next" >Validate</button>
                </div>
                <a href="javascript:void(0)" class="text-decoration-none ms-3 text-dark" id="resendCodeSms">Resend(1/3)</a>
            </div>
        </div>
    </div>
</div>
<script>
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
            if( response.data.data && localStorage.getItem("is_new") && localStorage.getItem("is_new") != '0'){
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
</script>
