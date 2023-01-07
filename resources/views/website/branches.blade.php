@extends('website.layout.master')

@section('content')
    <!-- the Section Start branch-->
    <section class="branch py-5">
        <div class="container">
            <Div class="row">

                @foreach($branches as $branch)
                 <div class="col-md-12 col-lg-6">
                     <a style="color:black" href="{{route('break.products.index',['branch_id' =>$branch['id']])}}">
                         <div class="branch-caeds">
                             <div>
                                 <p>{{ $branch['address'] }}</p>
                             </div>
                             <div class="d-flex align-items-center justify-content-between pt-3">
                                 <div>
                                     <button class="px-4" @if($branch['status'] == \App\Constants\Enum::BRANCH_CLOSED) style="background-color: #ffa188;color: #e73114;" @endif>{{ __('lang.'.$branch['status']) }}</button>
                                 </div>
                                 <div class="img-branch">
                                     <a href="{{ $branch['twitter_link'] }}" target="_blank">
                                         <img src="{{asset('')}}assets/website/img/twitter.png" alt="">
                                     </a>

                                     <a href="{{ $branch['user']['phone'] }}" target="_blank">
                                         <img src="{{asset('')}}assets/website/img/phone.png" alt="">
                                     </a>
                                     <a href="https://www.google.com/maps/{{$branch['coordinate']}}" target="_blank">
                                         <img src="{{asset('')}}assets/website/img/user.png" alt="">
                                     </a>
                                     <a href="{{ $branch['instagram_link']}}" target="_blank">
                                         <img src="{{asset('')}}assets/website/img/instagram.png" alt="">
                                     </a>
                                 </div>
                             </div>
                         </div>
                     </a>

                </div>
                @endforeach
{{--                <div class="text-center py-5">--}}
{{--                    <button class="box-button fs-5 butt-bran" >--}}
{{--                        التالي--}}
{{--                        <i class="fa-sharp fa-solid fa-left-long pe-2"></i>--}}
{{--                    </button>--}}
{{--                </div>--}}
            </Div>
        </div>
    </section>
    <!-- the Section End branch-->
@endsection
