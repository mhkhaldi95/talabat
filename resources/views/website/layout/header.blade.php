


<!-- landing padge -->
<header class="landing-header">

    <!-- navbar -->
    <nav class="bg-custom ">
        <div class="container nav-container">
            <div class="row align-items-center">
                <div class="col-6">
                    <div class="logo">
                        <a href="{{route('break.index')}}">{{$settings->site_name}}</a>
                    </div>
                </div>
                <div class="col-6 d-flex align-items-baseline justify-content-end">
                    @if(\Illuminate\Support\Facades\Auth::check())
                        <a href="{{route('products.search',['branch_id' =>@$branch->id])}}" class="search-icon">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </a>
                        <a href="{{route('customer.account',['branch_id' =>@$branch->id])}}" class="user mx-4" style="cursor: pointer;">
                            <img src="{{asset('')}}assets/website/images/user-nav.png" alt="" class="w-20px h-20px">
                        </a>
                    @else
                        <a href="javascript:void(0)" id="customer_login" class="user mx-4" style="cursor: pointer;">
                            <img src="{{asset('')}}assets/website/images/user-nav.png" alt="" class="w-20px h-20px">
                        </a>
                    @endif


                    <div class="lang-select">
                        <select name="format" id="format"
                                onchange="javascript:handleSelect(this)">
                            <option id="select_en"
                                    value="{{route('setLocale','en')}}" {{app()->getLocale() != 'ar'?'selected':''}} >En
                            </option>
                            <option id="select_ar"
                                    value="{{route('setLocale','ar')}}" {{app()->getLocale() == 'ar'?'selected':''}} >Ar
                            </option>
                        </select>
                    </div>


                </div>

            </div>
        </div>
    </nav>
    <!-- ../navbar -->

</header>
