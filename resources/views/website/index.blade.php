@extends('website.layout.master')
@section('style')
    <style>
        /* body{
            background-image:url('img/Image\ 18.png');
            background-repeat: no-repeat;
            background-size: 100% 950px;
        } */
        .box-in-img img{
            width: 100%;
            height: 630px;
        }
        .box-index{
            position: relative;
        }
        .postion{
            position: absolute;
            top: 50%;
            right: 33%;
            left: 32%;
        }
        .box-pos{
            padding: 10px;
            background-color: white;
            border-radius: 8px;
        }
        .but-index{
            width: 200px;
        }
        @media only screen and (max-width:750px) {
            .box-in-img img {
                width: 100%;
                height: 756px;
            }
            .postion {
                right: 5%;
                left: 8%;}

        }
    </style>
@endsection
@section('content')

    <!-- the Section End NavBar -->
    <div class="box-index">
        <div class="box-in-img">
            <img src="{{asset('')}}assets/website/img/Image 18.png" alt="">
        </div>
        <div class="postion">
            <div class="box-pos text-center">
                <p class="fs-4">{{__('lang.request_now')}}</p>
            </div>
            <div class="text-center pt-4">
                <a href="{{route('break.branches.index')}}">
                    <button class="box-button but-index fs-5">
                        {{__('lang.select_branch')}}
                    </button>
                </a>


            </div>

        </div>
    </div>

    <!-- the Section Start Footer-->
@endsection
