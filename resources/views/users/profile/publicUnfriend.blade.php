@extends('layout')

@section('custom-css')
    <link href="{{ asset('css/styleProfile.css') }}" rel="stylesheet">
@endsection

@section('title')
    profile - {{ $user->name }}
@endsection


@section('contant')
    <!-- ======= Header ======= -->
    @include('navBar')
    <!-- End Header -->



    <main>
        <section>
            <div class="main-div  ">

                @include('users.profile.post.createPost')


                <div class="container identy-Profile">
                    <p>Members › {{ $user->name }}</p>
                </div>
                @include('success')


                <div class="contentProfile justify-content-center">
                    <div class="informationsProfile">
                        <div class="Client_img">
                            <img class="rounded-circle " src="{{ asset('storage/' . $user->image) }}" alt="Client image">
                        </div>

                        <div class="info_client text-center">
                            <p>
                                {{ $user->name }}<br>
                            </p>
                        </div>


                        @if ($user->id != Auth::id())
                            <div class="d-flex justify-content-center mb-2">

                                @if ($ifFriends)
                                    <form action="{{ url('follow/remove') }}" method="post">
                                        @csrf
                                        {{-- <input type="hidden" name="following" value="true"> --}}
                                        <input type="hidden" name="friend_id" value="{{ $user->id }}">
                                        <button class="me-3 contact_Profile">remove</button>
                                    </form>
                                @else
                                    <form action="{{ url('follow/add') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="following" value="true">
                                        <input type="hidden" name="friend_id" value="{{ $user->id }}">
                                        <button class="me-3 contact_Profile">Follow</button>
                                    </form>
                                @endif

                                <button id="chatifyButton" data-id="{{ $user->id }}" class="contact_Profile"> Masseg
                                </button>
                            </div>
                        @endif


                        @if ($user->setting == 'private' && !$ifFriends && !($user->id == Auth::id()))
                            <button class=" folloewrs following_btn me-3 ms-5  ">Followers</button>
                            <button class="folloewrs following_btn  me-3 ">Following</button>
                            <div class="following_btn"></div>
                        @else
                            <div class="d-flex justify-content-center mb-2 mt-4">
                                <button class=" folloewrs following_btn me-3 ms-5  "
                                    onclick="follower_in_profilePOP()">Followers</button>
                                <button class="folloewrs following_btn  me-3 "
                                    onclick="following_in_profilePOP()">Following</button>
                                <div class="following_btn"></div>

                                @if ($user->id == Auth::id())
                                    <button onclick="edite_personalInfoPOP()" class="folloewrs edit_btn ">Edit
                                        Profile</button>
                                @endif
                            </div>
                        @endif

                        @include('follower.showFollower')
                        @include('follower.showFollowing')
                        @include('users.profile.editProfile')
                    </div>

                    @if ($user->setting == 'private' && !$ifFriends && !($user->id == Auth::id()))

                    <div class=" text-center justify-content-center">
                        This Acount is Private
                    </div>

                    @else
                        <div class="container-fluid">
                            <!-- <a class="navbar-brand" href="#recentActivity">Activity</a> -->
                            <div class="d-flex align-items-start">
                                <a href="#recentActivity" class="mt-1">Activity</a>

                                <button id="btn-WishList" class="review_inProfile mt-1" onclick="reviewPop()">
                                    <!-- <i class="fa-solid fa-user-plus AddUser"></i> -->
                                    <a class="link_review">Review</a>
                                </button>
                                @include('users.profile.review')

                                <br>

                                @if ($user->id == Auth::id())
                                    {{-- <form class="d-flex PuttingActivity">
                                <input class="shar_profile me-2 ml-auto p-3"
                                    placeholder=" Share your recent tours with friends in YallaRehla">
                                <button onclick="createPostPop()" class="addActivity" type="submit"><i class="fa-solid fa-plus"></i></button>
                            </form> --}}
                                    <div class="container">
                                        <div class="d-flex PuttingActivity">
                                            <div class="input-group">
                                                <input class="form-control shar_profile p-3"
                                                    placeholder="Share your recent tours with friends in YallaRehla">
                                                <button onclick="createPostPop()" class="btn  addActivity" type="submit">
                                                    <i class="fa-solid fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- Show resent Activity  --}}
                        <div id="recentActivity" class="recent-Activity">
                            <p class="headP-RecentActivity">Recent Activity</p>
                            <div class="post-Activity container">
                                <div class="row">

                                    @include('users.profile.post.show')
                                </div>
                            </div>
                        </div>
                    @endif




                </div>
            </div>
        </section>
    </main>



    <!-- End #main -->
@endsection

@section('scripts')
    <script>
        // Get the button element
        const chatifyButton = document.getElementById('chatifyButton');

        // Add an event listener to the button
        chatifyButton.addEventListener('click', function() {
            // Navigate to the desired URL when the button is clicked
            const id = chatifyButton.dataset.id;
            window.location.href = 'http://localhost:8000/chatify/' +
                id; // Replace 'https://example.com/chatify' with your actual URL
        });
    </script>


    <script>
        // Get the button element
        const ShowProfile = document.getElementById('ShowProfile');

        // Add an event listener to the button
        ShowProfile.addEventListener('click', function() {
            const id = ShowProfile.dataset.id;
            window.location.href = 'http://localhost:8000/users/AnyProfile/' + id;
        });
    </script>
@endsection
