<div id="addToursPop" class="addToursPop">
    <div id="addTours" class="addTours">
        <div id="viewAddTours_content" class="viewAddTours_content">
            <span class="close" onclick="closeaddToursPop()">&times;</span>

            <form method="POST" action="{{ url('tours/store') }}" enctype="multipart/form-data">
                @csrf

                <h3 class="container text-center">New Tour</h3>
                <p class="introfav  text-center">Lets add new tour </p>


                <div class="AddtourInfo">
                    <p class="TourInfo ms-5">Tour Information </p>
                    <div class="infoAddTour">
                        <table class="container">
                            <tr>
                                <div class="container ms-3 ">
                                    <td>
                                        <label class="TourName" for="fname">Tour Name : </label>
                                    </td>
                                    <td>
                                        <input required class="fillTourNameAdded" type="text" id="fname"
                                            name="name" value="{{ old('name', $tour->name ?? '') }}"><br><br>
                                    </td>
                                    @if ($errors->has('name'))
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
                                    @endif
                                </div>
                            </tr>


                            <tr>
                                <div class="container ms-3 ">
                                    <td>
                                        <label class="TourName" for="source">City Source : </label>
                                    </td>
                                    <td>
                                        <select class="fillTourNameAdded" name="source" id="Box">
                                            @php
                                                $myBoxName = 'source';
                                            @endphp
                                            @include('tours.place.City_ar')
                                        </select><br><br>
                                        {{-- if English .......  --}}
                                        {{-- if Arabic .......  --}}
                                    </td>
                                    @if ($errors->has('source'))
                                        <p class="text-danger">{{ $errors->first('source') }}</p>
                                    @endif
                                </div>
                            </tr>

                            {{-- {{dd($destinationCity)}} --}}
                            <tr>
                                <div class="container ms-3 ">
                                    <td>
                                        <label class="TourName" for="destination">City Destination : </label>
                                    </td>
                                    <td>
                                        @if ($ifSuggest)
                                            <select class="fillTourNameAdded" name="destination" id="Box">
                                                <option value="{{ $destination }}">{{ $destination }}</option>
                                            </select><br><br>
                                            <input type="hidden" value="{{ $idSuggerster }}" name="idSuggerster">
                                        @else
                                            <select class="fillTourNameAdded" name="destination" id="Box">
                                                @php
                                                    $myBoxName = 'destination';
                                                @endphp
                                                @include('tours.place.allPlace_ar')
                                                {{-- <input type="hidden" value="{{ $idSuggerster }}" name="idSuggerster"> --}}
                                            </select><br><br>
                                            {{-- if English .......  --}}
                                            {{-- if Arabic .......  --}}
                                        @endif

                                        @if ($errors->has('destination'))
                                            <p class="text-danger">{{ $errors->first('destination') }}</p>
                                        @endif
                                    </td>
                                </div>
                            </tr>


                            <tr>
                                <div class="container ms-3 ">
                                    <td>
                                        <label class="TourName" for="fname">Tour Price : </label>
                                    </td>
                                    <td>
                                        <input required class="fillpriceTour" type="text" id="fname"
                                            name="price" value="{{ old('price', $tour->price ?? '') }}"><br><br>
                                    </td>
                                </div>
                                @if ($errors->has('price'))
                                    <p class="text-danger">{{ $errors->first('price') }}</p>
                                @endif
                            </tr>

                            <tr>
                                <div class="container ms-3 ">
                                    <td>
                                        <label class="TourName" for="fname"> Maximum Number Participate: </label>
                                    </td>
                                    <td>
                                        <input required class="fillpriceTour" type="text" id="fname"
                                            name="max_participate"
                                            value="{{ old('max_participate', $tour->max_participate ?? '') }}"><br><br>
                                    </td>
                                </div>
                                @if ($errors->has('max_participate'))
                                    <p class="text-danger">{{ $errors->first('max_participate') }}</p>
                                @endif
                            </tr>

                            <tr>
                                <div class="container ms-3 ">
                                    <td>
                                        <label class=" ms-3 fillTime" for="Date">
                                            Date :</label>
                                    </td>
                                    <td>
                                        <input required class="fillTourDateAdded"type="date" id="DateTour"
                                            name="dateOFTour"
                                            value="{{ old('dateOFTour', $tour->dateOFTour ?? '') }}"><br><br>
                                    </td>
                                </div>
                                @if ($errors->has('dateOFTour'))
                                    <p class="text-danger">{{ $errors->first('dateOFTour') }}</p>
                                @endif
                            </tr>

                        </table>
                    </div>
                </div>

                <br><br>

                <div>
                    <div class="descrptiontTourInOwner mb-4 ms-3">
                        <p class="ms-5 addDscriptionIntro">Dscription : </p>
                        <!-- ====================================================== -->
                        <textarea required class=" writedescription me-3 " placeholder="Description Tour in Details " required
                            name="description"> {{ old('description', $tour->description ?? '') }}</textarea>

                        @if ($errors->has('description'))
                            <p class="text-danger">{{ $errors->first('description') }}</p>
                        @endif

                        <p class="ms-5 shortDescription mt-3 ">Short description Tour :</p>
                        <div class="d-flex ">
                            <div>
                                <div class="radioShortDescrption ms-5">
                                    <input class="radioChoice" type="checkbox"
                                        id="Mountain-biking"name="short_description" value="Mountain-biking">
                                    <label class="labelChoice "for=" Mountain-biking">Mountain biking</label><br>
                                </div>
                                <div class="radioShortDescrption">
                                    <input class="radioChoice" type="checkbox" id="Hiking" name="short_description[]"
                                        value="Hiking">
                                    <label class="labelChoice "for=" Hiking">Hiking</label><br>
                                </div>
                                <div class="radioShortDescrption">
                                    <input class="radioChoice" type="checkbox" id="Forest"
                                        name="short_description[]" value="Forest">
                                    <label class="labelChoice "for=" Forest">Forest</label><br>
                                </div>
                                <div class="radioShortDescrption">
                                    <input class="radioChoice" type="checkbox" id="View"
                                        name="short_description[]" value="View">
                                    <label class="labelChoice "for=" View">View</label><br>
                                </div>
                                <div class="radioShortDescrption">
                                    <input class="radioChoice" type="checkbox" id="Wildlife"
                                        name="short_description[]" value="Wildlife">
                                    <label class="labelChoice "for=" Wildlife">Wildlife</label><br>
                                </div>
                                <div class="radioShortDescrption">
                                    <input class="radioChoice" type="checkbox" id="Adventure"
                                        name="short_description[]" value="Adventure">
                                    <label class="labelChoice "for=" Adventure">Adventure</label><br>
                                </div>
                                <div class="radioShortDescrption">
                                    <input class="radioChoice" type="checkbox" id="Sporting"
                                        name="short_description[]" value="Sporting">
                                    <label class="labelChoice "for=" Sporting">Sporting</label><br>
                                </div>
                                <div class="radioShortDescrption">
                                    <input class="radioChoice" type="checkbox" id="safari-tours"
                                        name="short_description[]" value="safari-tours">
                                    <label class="labelChoice "for=" safari-tours">safari tours</label><br>
                                </div>
                                <div class="radioShortDescrption">
                                    <input class="radioChoice" type="checkbox" id="eco-tours"
                                        name="short_description[]" value="eco-tours">
                                    <label class="labelChoice "for=" eco-tours">eco-tours</label><br>
                                </div>
                                <div class="radioShortDescrption">
                                    <input class="radioChoice" type="checkbox" id="photographic-tours"
                                        name="short_description[]" value="photographic-tours">
                                    <label class="labelChoice "for=" photographic-tours">photographic
                                        tours</label><br>
                                </div>
                                <div class="radioShortDescrption">
                                    <input class="radioChoice" type="checkbox" id="Historical-tour"
                                        name="short_description[]" value="Historical-tour">
                                    <label class="labelChoice "for=" Historical-tour">Historical tour</label><br>
                                </div>
                            </div>
                        </div>

                        @if ($errors->has('short_description'))
                            <p class="text-danger">{{ $errors->first('short_description') }}</p>
                        @endif
                    </div>
                </div>
                <br><br>


                <div class=" places ">
                    <h3 class="text-center text-capitalize">Add picture of the tour to be organizedy</h3>
                    <br>
                    <p><i class=" pictureTourIcon  ms-5  material-icons">&#xe3b6;</i>
                        <input required type="file" name="image[]" multiple>
                    </p>

                    @if ($errors->has('image'))
                        <p class="text-danger">{{ $errors->first('image') }}</p>
                    @endif
                    <br><br>
                </div>
                <br><br>

                <div class=" places ">
                    <h3 class="text-center text-capitalize">through the way</h3>
                    <p class="text-center text-600 text-capitalize introfav">The places we will pass through
                        during our tour </p>
                    <p><i class=" locationIcon  ms-5 fa-solid fa-location-pin"></i>
                        <label class="fillplaces"for="fname">Place Name : </label>
                        <select required class="fillTourNameAdded" name="cityBox" id="cityBox">
                            @php
                                $myBoxName = 'cityBox';
                            @endphp
                            @include('tours.place.City_ar')
                        </select>
                    </p>

                    <br>
                    <input id="resultPlace" required class="resultPlace writedescription me-3" name="path"
                    name="path" value="{{ old('path', $tour->path ?? '') }}"/>

                    {{-- <input required class="resultPlace" id="resultPlace" name="path"
                        value="{{ old('path', $tour->path ?? '') }}" /> <br> --}}

                    <button id="AddPlace" class="AddMorePlace">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                    <button id="removePlace" class="AddMorePlace">
                        <i class="fa-solid fa-minus"></i>
                    </button>
                    <hr>



                </div>
                <br><br>



                <div class="addTour_inDetials ">
                    <div class="putActivity justify-content-center">
                        <h3 class="text-center  mb-3">Activities in the Tour </h3>
                        <p class="text-center introAllActivities">All activities that will be doing</p>
                        <div class="steps-Tour  d-flex justify-content-center ">
                            <div class=" d-flex ">
                                <div class="content-step content-stepInAddTour ">
                                    <p class="text-capitalize"> <i class="fa-brands fa-medapps ms-1 mt-2  "></i><span>
                                            our Activities</span></p>
                                    <br>

                                    <div class="item position-relative ps-4 ms-3">
                                        <h4 class="fs-5"> <label>AT </label>
                                            <input required type="time" id="appt" name="time[]">
                                        </h4>
                                        <input class="act"  required  name="activity[]" >
                                    </div><br>

                                    <div id="container"></div>


                                    <button id="addActivity" class="AddMorePlace">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>

                                    <button id="removeActivity" class="AddMorePlace">
                                        <i class="fa-solid fa-minus"></i>
                                    </button>

                                </div>
                                <input type="hidden" name="numberOfActivity" id="numberOfActivity">
                            </div>
                        </div>
                    </div>
                    @if ($errors->has('activity'))
                        <p class="text-danger">{{ $errors->first('activity') }}</p>
                    @endif
                    @if ($errors->has('time'))
                        <p class="text-danger">{{ $errors->first('time') }}</p>
                    @endif
                </div>
                <br><br>

                {{-- if Owner_take_tour ..  --}}
                <button id="btn-Login" class="nav-link" type="submit">Create</button>
            </form>
        </div>
    </div>
</div>
