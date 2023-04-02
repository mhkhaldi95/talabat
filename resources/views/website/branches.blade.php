@extends('website.layout.master')
@section('head')
    <link rel="stylesheet" href="{{asset('')}}assets/website/css/choose-branch.css"/>
@endsection

@section('content')

    <section class="branches">
        <div class="container branche-content">

            <form action="" class=" row my-5" id="branch_form">
                @foreach($branches as $branch)
                <div class="col-md-6 ">
                    <input type="radio" class="btn-check select_branch" value="{{$branch['id']}}" name="options-outlined" id="success-outlined_{{$branch['id']}}" autocomplete="off"
                           >
                    <label class="btn btn btn-outline-dark w-100 h-100" for="success-outlined_{{$branch['id']}}">
                        <div class="row align-items-baseline py-2">
                            <h5 class="card-title py-4" data-i18n="branchName">{{ $branch['address'] }}</h5>

                            <div class="col-4">
                                <button class="btn open-btn" @if($branch['status'] == \App\Constants\Enum::BRANCH_CLOSED) style="background-color: #ffa188;color: #e73114;" @endif>{{ __('lang.'.$branch['status']) }}</button>
                            </div>

                            <div class="col-8 text-center branch-contacts">
                                <a  href="https://www.google.com/maps/{{$branch['coordinate']}}" class="me-md-4 me-0 text-reset branch-contact">
                                    <i class="fa-solid fa-location-dot"></i>
                                </a>
                                <a href="{{ $branch['instagram_link']}}" class="me-md-4 me-0 text-reset branch-contact">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="https://wa.me/{{ $branch['user']['phone'] }}" class="me-md-4 me-0 text-reset branch-contact">
                                    <i class="fa-solid fa-phone-volume"></i>
                                </a>
                                <a href="{{ $branch['twitter_link']}}" class="me-md-4 me-0 text-reset  branch-contact">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </div>
                        </div>

                    </label>
                </div>
                @endforeach



            </form>
            <div class="row">
                <div class="col">
                    <div class="col text-center intro-btn">
                        <a href="javascript:void(0)" class="btn btn-primary next_branch" data-i18n="custimizeBranch">
                            Next >></a
                        >
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

