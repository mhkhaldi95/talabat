@extends('website.layout.master')
@section('content')
    <section class="land-home">
        <div class="container">

            <div class="column home-intro">

                <div class="col text-center  mb-4 intro-title p-3 ">
                    <p> {{__('homeIntro')}}</p>
                </div>

                <div class="col text-center intro-btn">
                    <a href="{{route('break.branches.index')}}" class="btn btn-primary" data-i18n="custimizeBranch"> {{__('custimizeBranch')}}</a>
                </div>

            </div>

        </div>
    </section>
@endsection




