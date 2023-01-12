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

</div>
<div style="padding-right: 9%" id="mobile_hide"  class="selector_hide">
    <span class="text-danger hide "> أدخل الكود كاملا </span>
</div>
<h6 class="text-center text-muted under" id="resendCodeSms">
    اعادة الارسال مرة اخري
</h6>
<div class="modal-footer button-next" id="modal-check-code-next">
    <button class="box-button fs-5">
        التالي
    </button>
</div>
