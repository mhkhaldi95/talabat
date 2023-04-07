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
        $(document).off('click', '#accept_order').on('click', '#accept_order', function (e) {


            var order_id = $('#modal_order_id').val()
            var branch_id = $('#modal_branch_id').val()
            var x = localStorage.getItem("xInterval_"+order_id);
            if(order_id && branch_id){
                if(x){
                    window.clearInterval(parseInt(x));
                    localStorage.removeItem("xInterval_"+order_id)
                }

                axios.post("{{route('branch.orders.accept')}}",{
                    order_id: order_id,
                    branch_id:'{{auth()->user()->branch->id}}',
                }).then(response => {
                    if(response.data.status){
                        $('#countDown').modal('hide')
                        toastr.success("تم قبول الطلبية بنجاح");
                    }

                }).catch(error => {
                    toastr.warning("حدث خطا ما");
                });
            }else{
                toastr.warning("حدث خطا ما");
            }


        })
        $(document).off('click', '#reject_order').on('click', '#reject_order', function (e) {


            var order_id = $('#modal_order_id').val()
            var branch_id = $('#modal_branch_id').val()
            var x = localStorage.getItem("xInterval_"+order_id);
            if(order_id && branch_id){
                window.clearInterval(x);
                localStorage.removeItem("xInterval_"+order_id)
                axios.post("{{route('branch.orders.reject')}}",{
                    order_id: order_id,
                    branch_id:'{{auth()->user()->branch->id}}',
                }).then(response => {
                    if(response.data.status){
                        $('#countDown').modal('hide')
                        toastr.warning("تم رفض الطلبية بنجاح");
                    }
                }).catch(error => {
                    toastr.warning("حدث خطا ما");
                });
            }else{
                toastr.warning("حدث خطا ما");
            }


        })


    });
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
