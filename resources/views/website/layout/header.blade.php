<section class="NavBar d-fl">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <p class="font-s">BREAK</p>
            </div>
            <div>
                <a href="#">
                    <i class="fa-solid fa-magnifying-glass ps-3"></i>
                </a>
                @if(\Illuminate\Support\Facades\Auth::check())
                   <a href="{{route('customer.account',['branch_id' =>@$branch->id])}}">
                       <i class="fa-solid fa-user ps-3 size-icon"></i>
                   </a>
                @endif
                <span class="fs-3 ">En</span>
            </div>
        </div>
    </div>
</section>
