
<!-- Modal Header -->
<div class="modal-header">
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>
<!-- Modal body -->
<div class="modal-body">
    <p class="text-center">complete registeration</p>
    <div class="input-group flex-nowrap mb-3">
        <input type="text" id="name" class="form-control" placeholder="Username" aria-label="Username"
               aria-describedby="addon-wrapping">
    </div>
    <div style="padding-right: 9%" id="name_hide"  class="selector_hide">
        <span class="text-danger hide "> أدخل  الاسم </span>
    </div>
    <button class="w-100 btn  bg-main" id="modal-enter-name-done">
        done
    </button>
</div>
<script>

    $(document).on('click','#modal-enter-name-done',function (e) {
        console.log("X")
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
</script>
