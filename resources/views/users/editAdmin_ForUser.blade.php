@extends('layout')

@section('custom-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
    <link rel="stylesheet" href="{{ asset('css/tailwind.output.css') }} " />
@endsection

@section('title')
    Edit Type
@endsection

@section('script-pop')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("editUserInfoPop").style.display = "block";
        });
    </script>
@endsection


@section('contant')
    <!-- ======= Header ======= -->
    @include('navBar')
    <!-- End Header -->


    <div id="editUserInfoPop" class="editUserInfoPop">
        <div id="EditMain" class="EditMain">
            <div id="editInfoUser" class="editInfoUser">
                <span class="close" onclick="closeedEditUserInfoPop()">&times;</span>
                <h3 class=" intro_editing container  ps-5 ">Edit Profile Information </h3>


                <form class="container" method="POST" action="{{ url('updateTypeUser') }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="AddtourInfo">
                        <div class="infoAddTour container">

                            <br>
                            <span>Full name</span>
                            <input class="infoSignUp" type="text" name="name"
                                value="{{ old('name', $user->name ?? ($user->name ?? '')) }}">
                            <br>

                            <span>Type for User</span>
                            <select name="type" id="type">
                                <option value="admin" {{ $user->type === 'admin' ? 'selected' : '' }}>Admin </option>
                                <option value="tour_owner" {{ $user->type === 'tour_owner' ? 'selected' : '' }}>Tour Owner
                                </option>
                                <option value="user" {{ $user->type === 'user' ? 'selected' : '' }}>User</option>
                            </select>
                            @error('type')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <br>

                            <input type="hidden" value="{{ $user->type }}" name="oldType">
                            <input type="hidden" value="{{ $user->id }}" name="user_id">
                            <input class="login_info  container" type="submit" name="submit" value="update">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    @include('users.showCurd')



    <!-- End #main -->
@endsection
