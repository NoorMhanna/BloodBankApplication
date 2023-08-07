@extends('layout')

@section('title')
    Main Page
@endsection


@section('contant')
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center me-auto me-lg-0">
                <h1>YallaRehlla<span>.</span></h1>
            </a>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="#hero">{{trans('slidebar.HOME')}} </a></li>
                    <li><a href="#why-us">{{trans('slidebar.Servies')}} </a></li>
                    <li><a href="#available-tour">{{trans('slidebar.Available tours')}}</a></li>
                    <li><a href="#gallery">{{trans('slidebar.Owner Tours')}} </a></li>
                    <li><a href="#contact">{{trans('slidebar.Contact')}}</a></li>


                    <li class="nav-item dropdown">
                        <a> <i class="fa-solid fa-earth-americas"></i> </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ LaravelLocalization::getLocalizedURL('ar') }}">{{trans('slidebar.Arabic')}} </a>
                            </li>
                            <li><a class="dropdown-item"
                                    href=" {{ LaravelLocalization::getLocalizedURL('en') }}">{{trans('slidebar.English')}}</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>

            <button id="btn-Login" class="btn-login" onclick="login()">{{trans('slidebar.Log in')}} </button>

            @include('auth.login')
        </div>
    </header>
    <!-- End Header -->


    <main id="main">

        {{-- Brife:  --}}
        @include('brief.index');

        <!-- ======= Serviec ======= -->
        @include('service.index')

        <!-- ======= Feedback ======= -->
        {{-- @include('feedback.siteFeedback') --}}

        <!-- ======= available tour ======= -->
        @include('tours.availableTour')

        <!-- ======= Follower Section ======= -->
        @include('follower.FollowOwner')

        {{-- <!-- ======= Previous tour ======= --> --}}
        @include('tours.PreviousTour')

        <!-- ======= Contact Section ======= -->
        @include('brief.content')
    </main>

    <!-- End #main -->
@endsection
