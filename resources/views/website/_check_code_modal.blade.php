<div class="modal-header head2">
    <button type="button" class="btn-close right" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<h4 class="text-center text-muted">
    ادخل كود التحقق المرسل لرقمك
    {{$phone}}</h4>
<div class="modal-body d-flex justify-content-center">
    <form class="check">
        <input type="text" id="check_input_1">
        <input type="text" id="check_input_2">
        <input type="text" id="check_input_3">
        <input type="text" id="check_input_4">
        <input type="text" id="check_input_5">

    </form>
    <div style="padding-right: 9%" id="mobile_hide"  class="selector_hide">
        <span class="text-danger hide "> أدخل الكود كاملا </span>
    </div>
</div>
<h6 class="text-center text-muted under">
    اعادة الارسال مرة اخري
</h6>
<div class="modal-footer button-next" id="modal-check-code-next">
    <button class="box-button fs-5">
        التالي
    </button>
</div>
<script>
    $('#modal-check-code-next').click("on",function() {

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
        axios.post('{{route('checkCodeSms')}}',{phone:localStorage.getItem('phone'),code:code}).then(response => {
           window.location.reload()

        }).catch(error => {

        });

    })

</script>
