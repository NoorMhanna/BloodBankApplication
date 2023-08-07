<div id="edite_personalInfoPOP" class="edite_personalInfoPOP" style="display: none">
    <div id="editing" class="editing">
        <div id="editInfoForProfile" class="editInfoForProfile">
            <span class="close" onclick="closeEdite_personalInfoPOP()">&times;</span>
            <h3 class=" container text-center">Edit Profile Information </h3>


            <div>
                <form class="container" method="POST" action="{{ url('users/update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="UserInfo">
                        <p class="UserInfo ms-5 mt-4">Clients Page </p>
                        <div class="change_info_user">

                            <div class="ms-3 ">
                                <label class="editUserName " for="fname">Change Username :</label><br>
                                <!-- <form action="/action_page.php"> -->
                                <input value="{{$user->name }}" class="" id="imgTour" name="name">
                                <br>
                                @if ($errors->has('name'))
                                <p class="text-danger">{{ $errors->first('name') }}</p>
                                <br>
                            @endif


                                <label class="editImage " for="fname">Change Profile Image:</label><br>
                                <!-- <form action="/action_page.php"> -->
                                <input class="" type="file" id="imgTour" name="image">
                                <br>
                                @if ($errors->has('image'))
                                <p class="text-danger">{{ $errors->first('image') }}</p>
                                <br>
                            @endif


                                <label class="editImage " for="fname">Change Password:</label><br>
                                <!-- <form action="/action_page.php"> -->
                                <input class="" type="password" id="imgTour" name="password">
                                <br>
                                @if ($errors->has('password'))
                                    <p class="text-danger">{{ $errors->first('password') }}</p>
                                    <br>
                                @endif


                                <label class="editImage " for="fname">Phone Number</label><br>
                                <!-- <form action="/action_page.php"> -->
                                <input class="" type="text" id="imgTour" name="phone_number" value="{{  $user->phone_number }}" >
                                <br>
                                @if ($errors->has('phone_number'))
                                <p class="text-danger">{{ $errors->first('phone_number') }}</p>
                                <br>
                            @endif

                                <label class="editImage" for="fname">Privacy</label><br>




                                <input type="radio" id="public" name="setting" value="public">
                                <label class="editImage "  name="public" for="public">public</label>
                                <input type="radio" id="private" name="setting" value="private">
                                <label class="editImage" for="private">private</label>
                                @if ($errors->has('setting'))
                                    <p class="text-danger">{{ $errors->first('setting') }}</p>
                                    <br>
                                @endif

                            </div>
                        </div>
                    </div>



                    <input type="hidden" value="{{ Auth::id() }}" name="user_id">
                    <input class="Submit_Join container" type="submit" value="update">
                </form>
            </div>

            <!-- <p class="introfav container text-center">Your favorite tours </p> -->


        </div>
    </div>
</div>
