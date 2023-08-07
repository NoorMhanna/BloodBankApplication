<div id="createPostPop" class="createPostPop" style="display: none">
    <div id="EditMain" class="EditMain">
        <div id="createInfoForPost" class="createInfoForPost">
            <span class="close" onclick="closeedcreatePostPop()">&times;</span>
            <h3 class=" intro_editing container  ps-5 ">Create Your Post </h3>


            <form class="container" method="POST" action="{{ url('users/post/store') }}" enctype="multipart/form-data">
                @csrf
                <div class="AddtourInfo">
                    <div class="infoAddTour container">

                        <div>
                            <span>description &nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <input class="infoSignUp" type="text" name="description" value=""
                                placeholder="Enter description"><br><br>
                            @error('description')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="container">
                            <!-- <p> user Photo</p> -->
                            <span>Image</span>
                            <input type="file" name="image" value=" " class="form-control mb-3">
                            @error('image')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <input class="Submit_Join container" type="submit" name="submit" value="add">
                    </div>
                </div>
            </form>

            <!-- <p class="introfav container text-center">Your favorite tours </p> -->


        </div>
    </div>
</div>
