
@extends('layout')

@section('custom-css')
<link href="{{asset('css/styleProfile.css')}}" rel="stylesheet">
@endsection

@section('title')
{{$user->name}} Profile

@endsection


@section('contant')
    <!-- ======= Header ======= -->
    @include('navBar')
    <!-- End Header -->



    <main>
        <section>
            <div class="main-div">
                <div class="container identy-Profile">
                    <p>Members › {{$user->name}}</p>
                </div>

                <div class="contentProfile justify-content-center">
                    <div class="informationsProfile">
                        <div class="Client_img">
                            <img class="rounded-circle " src="{{asset('storage/'.$user->image)}}" alt="Client image">
                        </div>
                        <div class="info_client text-center">
                            <p>
                                {{$user->name}}<br>

                                @if ($user->city != "null")
                                    {{$user->city ,}}
                                @endif
                                @if ($user->town != "null")
                                    {{$user->town }}
                                @endif
                            </p>

                        </div>

                        {{-- depend on private/public ...  --}}
                        @include('users.profile.public')



                    <div class="recent-Activity">
                        <p class="headP-RecentActivity">Recent Activity</p>
                        <div class="post-Activity d-flex justify-content-around">

                            @if($ifAvailable== true)
                            @include('users.profile.post.show')
                            @else
                            <div>
                            <p>This Account is Private</p>
                            <form action="{{ url('follow/add') }}" method="post">
                                @csrf
                                {{-- <input name="user_id" type="hidden" value="{{}}"> --}}
                                {{-- <input name="friend_id" type="hidden" value="2"> --}}
                                <input type="hidden" name="friend_id" value="{{ $user->id }}">
                                <button type="submit" class="addFollower">Follow to see his/her posts</button>

                            </form>
                            </div>
                            @endif

                    </div>

                </div>



            </div>

        </section>



    </main>









    <!-- End #main -->
@endsection

