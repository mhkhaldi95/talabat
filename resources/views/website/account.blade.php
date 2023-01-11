@extends('website.layout.master')
@section('content')
    <!-- the Section Start control -->
    <section class="control py-5 ">
        <div class="container">
            <div class="d-flex responsev">
                <div class="tab">
                    <button class="tablinks" onclick="openTab(event, 'firstTab')" id="defaultOpen"><i class="fa-solid fa-user ps-2"></i>
                        بياناتي </button>
                    <button class="tablinks" onclick="openTab(event, 'secondTab')"><i class="fa-solid fa-calendar-days ps-2"></i>
                        طلباتي</button>
                    <a href="{{route('break.logout',['branch_id' =>$branch->id])}}">
                        <button class="color-out"><i class="fa-solid fa-right-from-bracket color-out ps-2"></i>
                            <span class="color-out fs-5"> تسجيل الخروج</span>
                        </button>
                    </a>

                </div>
                <div id="firstTab" class="tabcontent ">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <form>
                                <div class="row">
                                    <div class="col-md-12 col-lg-6">
                                        <label for="inputEmail4" class="fw-bold text-muted py-2"> الاسم الأول</label>
                                        <input type="text" class="form-control py-2" placeholder="الاسم الأول">
                                    </div>
                                    <div class="col-md-12 col-lg-6">
                                        <label for="inputEmail4" class="fw-bold text-muted py-2"> رقم الهاتف</label>
                                        <input type="text" class="form-control py-2" placeholder=" رقم الهاتف">
                                    </div>
                                    <div class="col-md-12 col-lg-6">
                                        <div class="my-3">
                                            <label for="inputEmail4" class="fw-bold text-muted py-2"> البريد الإلكترونى</label>
                                            <input type="text" class="form-control py-2" placeholder="البريد الإلكترونى">
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-6">
                                        <div class="my-3">
                                            <label for="inputEmail4" class="fw-bold text-muted py-2"> الجنس</label>
                                            <input type="text" class="form-control py-2" placeholder="الجنس">
                                        </div>
                                    </div>
                                    <div class="button-profile">
                                        <button class="box-button fs-5">
                                            حفظ
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <div id="secondTab" class="tabcontent">
                    <div class="">
                        <ul class="nav nav-pills right-acc mb-2 d-flex justify-content-between" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="btn active butt-accont butt-accont-rigth" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                                        type="button" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fa-solid fa-calendar-days ps-2 "></i> طلبات جديدة </button>
                            </li>
                            <li class="nav-item" role="presentation ">
                                <button class="btn butt-accont px-3 mob" id="pills-profile-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                                        aria-selected="false"><i class="fa-sharp fa-solid fa-list  ps-2 "></i> سجل الطلبات  </button>
                            </li>
                        </ul>

                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                <div class="row">
                                    <div class="col-md-12 col-lg-6">
                                        <div class="cards text-center">
                                            <DIV class="box-cat-img">
                                                <IMG src="{{asset('')}}assets/website/img/Screenshot 2022-12-08 at 1.36.33 PM.png"></IMG>
                                            </DIV>
                                            <div class="padd-r">
                                                <p class=" py-3 fs-3">جليز</p>
                                                <p class="pb-3 ">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص
                                                    العربى
                                                </p>
                                                <div class="bx-but py-1">
                                                    <p class="pt-2 ">استلام من الفرع</p>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="cards text-center">
                                            <DIV class="box-cat-img">
                                                <IMG src="{{asset('')}}assets/website/img/Screenshot 2022-12-08 at 1.36.33 PM.png"></IMG>
                                            </DIV>
                                            <div class="padd-r">
                                                <p class=" py-3 fs-3">جليز</p>
                                                <p class="pb-3 ">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص
                                                    العربى
                                                </p>
                                                <div class="bx-but py-1">
                                                    <p class="pt-2 ">استلام من الفرع</p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-6">
                                        <div class="cards text-center">
                                            <DIV class="box-cat-img">
                                                <IMG src="{{asset('')}}assets/website/img/Screenshot 2022-12-08 at 1.36.33 PM.png"></IMG>
                                            </DIV>
                                            <div class="padd-r">
                                                <p class=" py-3 fs-3">جليز</p>
                                                <p class="pb-3 ">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص
                                                    العربى
                                                </p>
                                                <div class="bx-but py-1">
                                                    <p class="pt-2 ">استلام من الفرع</p>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="cards text-center">
                                            <DIV class="box-cat-img">
                                                <IMG src="{{asset('')}}assets/website/img/Screenshot 2022-12-08 at 1.36.33 PM.png"></IMG>
                                            </DIV>
                                            <div class="padd-r">
                                                <p class=" py-3 fs-3">جليز</p>
                                                <p class="pb-3 ">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص
                                                    العربى
                                                </p>
                                                <div class="bx-but py-1">
                                                    <p class="pt-2 ">استلام من الفرع</p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                <div class="row">
                                    <div class="col-md-12 col-lg-6">
                                        <div class="cards text-center">
                                            <DIV class="box-cat-img">
                                                <IMG src="{{asset('')}}assets/website/img/Screenshot 2022-12-08 at 1.36.33 PM.png"></IMG>
                                            </DIV>
                                            <div class="padd-r">
                                                <p class=" py-3 fs-3">جليز</p>
                                                <p class="pb-3 ">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص
                                                    العربى
                                                </p>
                                                <div class="bx-but py-1">
                                                    <p class="pt-2 gree">تم التسليم </p>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="cards text-center">
                                            <DIV class="box-cat-img">
                                                <IMG src="{{asset('')}}assets/website/img/Screenshot 2022-12-08 at 1.36.33 PM.png"></IMG>
                                            </DIV>
                                            <div class="padd-r">
                                                <p class=" py-3 fs-3">جليز</p>
                                                <p class="pb-3 ">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص
                                                    العربى
                                                </p>
                                                <div class="bx-but py-1">
                                                    <p class="pt-2 gree">تم التسليم </p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-6">
                                        <div class="cards text-center">
                                            <DIV class="box-cat-img">
                                                <IMG src="{{asset('')}}assets/website/img/Screenshot 2022-12-08 at 1.36.33 PM.png"></IMG>
                                            </DIV>
                                            <div class="padd-r">
                                                <p class=" py-3 fs-3">جليز</p>
                                                <p class="pb-3 ">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص
                                                    العربى
                                                </p>
                                                <div class="bx-but py-1">
                                                    <p class="pt-2 gree">تم التسليم </p>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="cards text-center">
                                            <DIV class="box-cat-img">
                                                <IMG src="{{asset('')}}assets/website/img/Screenshot 2022-12-08 at 1.36.33 PM.png"></IMG>
                                            </DIV>
                                            <div class="padd-r">
                                                <p class=" py-3 fs-3">جليز</p>
                                                <p class="pb-3 ">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص
                                                    العربى
                                                </p>
                                                <div class="bx-but py-1">
                                                    <p class="pt-2 gree">تم التسليم </p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- the Section End control -->
@endsection
@section('script')
    <script src="{{asset('')}}assets/website/js/index.js"></script>

    <script>
        function openTab(evt, cityName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }

        document.getElementById("defaultOpen").click();
    </script>
@endsection
