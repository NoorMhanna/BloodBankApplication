@extends('layout')

@section('title')
    Home Page
@endsection


@section('contant')
    <!-- ======= Header ======= -->
    @include('navBar')
    <!-- End Header -->


    <main id="main">



        <!-- ======= Brife ======= -->
        @include('brief.index');

        <!-- ======= Follower Section ======= -->
        @include('follower.FollowFrinds')

        <!-- ======= available tour ======= -->
        @include('tours.availableTour')

        <!-- ======= Previous tour ======= ??????? -->
        @include('tours.PreviousTour')

        <!-- ======= Suggest toue : ======= -->
        @include('tours.suggestTour.index')


        <!-- ======= Map show all tours ======= -->
        @include('map.Alltours')

        <!-- ======= Contact Section ======= -->
        @include('brief.content')
    </main>

    <!-- End #main -->
@endsection



