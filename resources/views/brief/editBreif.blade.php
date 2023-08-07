



<div id="editMainAdminPop" class="editMainAdminPop">
    <div id="EditMain" class="EditMain">
        <div id="editInfoForAdmin" class="editInfoForAdmin">
            <span class="close" onclick="closeeditMainAdminPop()">&times;</span>
            <h3 class=" intro_editing container  ps-5 ">Edit Information </h3>


            <form method="post" action="{{ url('brief/update') }}"  enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="AddtourInfo">
                    <p class="TourInfo ms-5 mt-4">Clients Page </p>
                    <div class="infoAddTour">
                        {{-- <form action="curdOwnerTour.html"> --}}

                            <div class="ms-3 ">
                                <label class="TourName" for="fname">Change Brief Description : </label>
                                <!-- <input  type="text" id="fname" name="fname"><br><br> -->
                                <textarea class="fillTourNameAdded"id="w3review" name="brief" cols="40">
                                    {{old('brief',$brief->brief ?? '')  }}</textarea>
                            </div>
                            <div class="ms-3 ">
                                <label class="priceTour" for="fname">Change Main Image : </label><br>
                                <!-- <form action="/action_page.php"> -->
                                <input class="fillpriceTour"type="file" id="imgTour" name="image">
                                <!-- <input type="submit"> -->
                                <!-- </form> -->
                                <!-- <input class="fillpriceTour" type="text" id="fname" name="fname"><br><br> -->
                            </div>
                        {{-- </form> --}}
                    </div>
                </div>
                <div class="AddtourInfo">

                    <p class="TourInfo ms-5 mt-4">Contacts </p>
                    <div class="infoAddTour">
                        {{-- <form action="curdOwnerTour.html"> --}}

                            <div class="ms-3 ">
                                <label class="TourName" for="email">Change Email contact : </label>
                                <input class="fillTourNameAdded" type="text" id="fname" value="{{old('email',$brief->email ?? '') }}" name="email"><br><br>

                            </div>
                            <div class="ms-3 ">
                                <label class="priceTour" for="call">Change phone contact : </label>
                                <input class="fillpriceTour" value="{{old('call',$brief->call ?? '') }}" type="text" id="fname" name="call"><br><br>
                            </div>
                        {{-- </form> --}}
                    </div>
                </div>

                <input type="hidden" value="{{$brief->id}}" name="brief_id">
                <input class="Submit_Join container" type="submit" name="submit" value="update">


            </form>

            <!-- <p class="introfav container text-center">Your favorite tours </p> -->


        </div>
    </div>
</div>
