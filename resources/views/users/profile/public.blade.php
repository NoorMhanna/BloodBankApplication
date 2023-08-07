

<div class="row">
    <div class="info-item-profile columnFirst">



        <a href="{{url('showFollowing')}}">

            <p href="{{url('/showFollowing')}}"><span>Following</span>
                {{count($Following)}}
            </p>
        </a>
        {{-- @include('follower.showFollowing') --}}


    </div>
    <div class="info-item-profile">

        <a href="{{url('showFollower')}}">
            <p><span>Followers</span>
                {{count($Followers)}}
            </p>
        </a>
        {{-- @include('follower.showFollower') --}}
    </div>

    <button id="btn-notefication" class="info-item-profile lastColumn" onclick="editProfilePop()">
        <p><span>Edit profile</span> <i class="fa-solid fa-pen"></i></p>
    </button>
    @include('users.profile.editProfile')



</div>







<nav class="navbar  navbar-expand-lg headerProfile">
<div class="container-fluid">
    <a class="navbar-brand" href="#">Activity</a>
    <div class="collapse navbar-collapse" id="navbarScroll">
        <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll"
            style="--bs-scroll-height: 100px;">
            <li class="nav-item">
                <a class="nav-link" href="{{url('/users/showAllFeedBack')}}">Review</a>
            </li>
        </ul>

        <div class="d-flex">
            <input class="shar_profile me-2"  placeholder=" Share your recent tours with friends in YallaRehla">
            <button id="btn-notefication" class="info-item-profile addActivity " onclick="createPostPop()">
                <p><i class="fa-solid fa-plus"></i></p>
            </button>
            @include('users.profile.post.createPost')
        </div>


    </div>
</div>
</nav>
