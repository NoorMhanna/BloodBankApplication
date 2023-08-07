

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

    <div class="info-item-profile lastColumn">
        <a href="{{url("users/edit/$user->id")}}"><p><span>Edit profile</span> <i class="fa-solid fa-pen"></i></p></a>
    </div>

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
        <form class="d-flex">
            <input class="shar_profile me-2"  placeholder=" Share your recent tours with friends in YallaRehla">
            <a href="{{url('users/post/create')}}" class="addActivity" type="submit"><i class="fa-solid fa-plus"></i></a>
        </form>


    </div>
</div>
</nav>






{{-- @if($ifAvailable== true)
@include('users.profile.post.show')
@else

<p>This Account is Private</p>
<form action="{{ url('follow/add') }}" method="post">
@csrf
<input type="hidden" name="friend_id" value="{{ $user->id }}">
<button type="submit" class="addFollower">Follow to see his/her posts</button>

</form>

@endif --}}
