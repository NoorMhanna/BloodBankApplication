@extends('layout')

@section('custom-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
    <link rel="stylesheet" href="{{ asset('css/tailwind.output.css') }} " />

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("addToursPop").style.display = "none";
            document.getElementById("EditTourPop").style.display = "block";
        });
    </script>
@endsection


@section('title')
    Update INFO {{ $tour->name }} Tour
@endsection


@section('contant')
    <!-- ======= Header ======= -->
    @include('navBar')
    <!-- End Header -->
    <div id="EditTourPop" class="EditTourPop">
        <div id="addTours" class="addTours">
            <div id="viewAddTours_content" class="viewAddTours_content">
                <span class="close" onclick="closeedEditTourPop()">&times;</span>
                <form method="POST" action="{{ url('tours/update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')


                    <h3 class="container text-center">Update INFO {{ $tour->name }} Tour</h3>

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

                                        </td>
                                        @if ($errors->has('source'))
                                            <p class="text-danger">{{ $errors->first('source') }}</p>
                                        @endif
                                    </div>
                                </tr>

                                <tr>
                                    <div class="container ms-3 ">
                                        <td>
                                            <label class="TourName" for="destination">City Destination :
                                            </label>
                                        </td>
                                        <td>
                                            <select class="fillTourNameAdded" name="destination" id="Box">
                                                @php
                                                    $myBoxName = 'destination';
                                                @endphp
                                                @include('tours.place.allPlace_ar')
                                            </select><br><br>
                                        </td>
                                        @if ($errors->has('destination'))
                                            <p class="text-danger">{{ $errors->first('destination') }}</p>
                                        @endif
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
                                            <label class="TourName" for="fname"> Maximum Number Participate:
                                            </label>
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
                            <textarea required class=" writedescription me-3 " placeholder="Description Tour in Details " required
                                name="description"> {{ old('description', $tour->description ?? '') }}</textarea>
                            @if ($errors->has('description'))
                                <p class="text-danger">{{ $errors->first('description') }}</p>
                            @endif

                            <p class="ms-5 shortDescription mt-3 ">Short description Tour :</p>

                            <div class="d-flex ">
                                <div>

                                    @php
                                        $shortDescription = json_decode($tour->short_description);
                                    @endphp

                                    <div class="radioShortDescrption ms-5">
                                        <input class="radioChoice" type="checkbox"
                                            id="Mountain-biking"name="short_description[]" value="Mountain-biking"
                                            {{ in_array('Mountain-biking', $shortDescription) ? 'checked' : '' }}>
                                        <label class="labelChoice "for=" Mountain-biking">Mountain
                                            biking</label><br>
                                    </div>
                                    <div class="radioShortDescrption ">
                                        <input class="radioChoice" type="checkbox" id="Hiking" name="short_description[]"
                                            value="Hiking" {{ in_array('Hiking', $shortDescription) ? 'checked' : '' }}>
                                        <label class="labelChoice "for=" Hiking">Hiking</label><br>
                                    </div>
                                    <div class="radioShortDescrption">
                                        <input class="radioChoice" type="checkbox" id="Forest"
                                            name="short_description[]" value="Forest"
                                            {{ in_array('Forest', $shortDescription) ? 'checked' : '' }}>
                                        <label class="labelChoice "for=" Forest">Forest</label><br>
                                    </div>
                                    <div class="radioShortDescrption">
                                        <input class="radioChoice" type="checkbox" id="View"
                                            name="short_description[]" value="View"
                                            {{ in_array('View', $shortDescription) ? 'checked' : '' }}>
                                        <label class="labelChoice "for=" View">View</label><br>
                                    </div>
                                    <div class="radioShortDescrption">
                                        <input class="radioChoice" type="checkbox" id="Wildlife"
                                            name="short_description[]" value="Wildlife"
                                            {{ in_array('Wildlife', $shortDescription) ? 'checked' : '' }}>
                                        <label class="labelChoice "for=" Wildlife">Wildlife</label><br>
                                    </div>
                                    <div class="radioShortDescrption">
                                        <input class="radioChoice" type="checkbox" id="Adventure"
                                            name="short_description[]" value="Adventure"
                                            {{ in_array('Adventure', $shortDescription) ? 'checked' : '' }}>
                                        <label class="labelChoice "for=" Adventure">Adventure</label><br>
                                    </div>
                                    <div class="radioShortDescrption">
                                        <input class="radioChoice" type="checkbox" id="Sporting"
                                            name="short_description[]" value="Sporting"
                                            {{ in_array('Sporting', $shortDescription) ? 'checked' : '' }}>
                                        <label class="labelChoice "for=" Sporting">Sporting</label><br>
                                    </div>
                                    <div class="radioShortDescrption">
                                        <input class="radioChoice" type="checkbox" id="safari-tours"
                                            name="short_description[]" value="safari-tours"
                                            {{ in_array('safari-tours', $shortDescription) ? 'checked' : '' }}>
                                        <label class="labelChoice "for=" safari-tours">safari
                                            tours</label><br>
                                    </div>
                                    <div class="radioShortDescrption">
                                        <input class="radioChoice" type="checkbox" id="eco-tours"
                                            name="short_description[]" value="eco-tours"
                                            {{ in_array('eco-tours', $shortDescription) ? 'checked' : '' }}>
                                        <label class="labelChoice "for=" eco-tours">eco-tours</label><br>
                                    </div>
                                    <div class="radioShortDescrption">
                                        <input class="radioChoice" type="checkbox" id="photographic-tours"
                                            name="short_description[]" value="photographic-tours"
                                            {{ in_array('photographic-tours', $shortDescription) ? 'checked' : '' }}>
                                        <label class="labelChoice "for=" photographic-tours">photographic
                                            tours</label><br>
                                    </div>
                                    <div class="radioShortDescrption">
                                        <input class="radioChoice" type="checkbox" id="Historical-tour"
                                            name="short_description[]" value="Historical-tour"
                                            {{ in_array('Historical-tour', $shortDescription) ? 'checked' : '' }}>
                                        <label class="labelChoice "for=" Historical-tour">Historical
                                            tour</label><br>
                                    </div>
                                </div>
                            </div>

                            @if ($errors->has('short_description'))
                                <p class="text-danger">{{ $errors->first('short_description') }}</p>
                            @endif
                        </div>
                    </div>
                    <br><br>

                    <div class="places">

                        @php
                            $images = json_decode($tour->images);
                        @endphp

                        <h3 class="text-center text-capitalize">Add picture of the tour to be organizedy</h3>
                        <br>
                        <p><i class=" pictureTourIcon  ms-5  material-icons">&#xe3b6;</i>
                            <input type="file" required name="image[]" multiple>
                        </p>
                        <div class="d-flex ml-4">
                        @foreach ($images as $image)
                            <img src="{{ asset('storage/' . $image) }}" style="height:40px" alt="Old image">
                        @endforeach
                        </div>
                        @if ($errors->has('image'))
                            <p class="text-danger">{{ $errors->first('image') }}</p>
                        @endif
                        <br><br>
                    </div>
                    <br><br>

                    <div class="places">
                        @php
                            $path = json_decode($tour->path);
                            $stringPath = [];
                            $x = '';
                            for ($i = 0; count($path) > $i; $i++) {
                                $stringPath[$i] = $path[$i]->place;
                                $x = $x . '-' . $stringPath[$i];
                            }
                        @endphp

                        <h3 class="text-center text-capitalize">through the way</h3>
                        <p class="text-center text-600 text-capitalize introfav">The places we will pass
                            through
                            during our tour </p>
                        <p><i class=" locationIcon  ms-5 fa-solid fa-location-pin"></i>
                            <label class="fillplaces"for="fname">Place Name : </label>
                            <select required class="fillTourNameAdded" name="cityBox" id="cityBox">
                                @php
                                    $myBoxName = 'cityBox';
                                @endphp
                                @include('tours.place.allPlace_ar')
                            </select>

                        </p>

                        <textarea required class=" writedescription me-3" name="path" placeholder="Description Tour in Details " required
                            name="description"> {{ $x }}</textarea>
                        <br>

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

                                        @php
                                            $allActivity = json_decode($tour->ActivityAndTime);
                                            $countTime = count($allActivity) / 2;
                                        @endphp

                                        @for ($i = 0; $i < count($allActivity) / 2; $i++, $countTime++)
                                            <div class="item position-relative ps-4 ms-3">
                                                <h4 class="fs-5"> <label>AT </label>
                                                    <input type="time" id="appt" name="time[]"
                                                        value="{{ $allActivity[$countTime] }}">
                                                </h4>
                                                <p class="act"><input type="text" id="fname" name="activity[]"
                                                        value="{{ $allActivity[$i] }}">
                                                </p>
                                            </div><br>
                                        @endfor

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

                    </div>
                    <br><br>

                    <input type="hidden" name="tour_id" value="{{ $tour->id }}">
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                    <button type="submit" id="btn-Login" class="nav-link">Update </button>
                </form>
            </div>
        </div>
    </div>
    <section id="mainAdminCurd" class="mainAdminCurd d-flex justify-content-center">

        <div class="contentCurdPage mt-5">

            <div class="d-flex SeachSection">
                <p class="mt-5 ms-5 center searchP">All tours organized by {{ $user->name }}</p>
                {{-- <label class="resultPlace" id="resultPlace"> </label> <br> --}}

                <button id="btn-AddTours" class="AddTourOwner"
                    onclick="window.location.href='{{ url('CurdWithPopCreate') }}'">
                    <i class="fa-solid fa-plus-square"></i>
                </button>

            </div>


            @include('tours._formCURD')
        </div>



    </section>





    <!-- End #main -->
@endsection


@section('scripts')
    <script>
        $(document).ready(function() {

            $('#AddPlace').click(function(event) {
                event.preventDefault();
                var selectedValue = $('#cityBox').val();
                var labelText = $('#resultPlace').text();
                $('#resultPlace').val(labelText + "-" + selectedValue);
                $('#resultPlace').text(labelText + "-" + selectedValue);
            });


            $('#removePlace').click(function() {
                event.preventDefault(event);
                var labelText = $('#resultPlace').text().trim();
                var lastSpaceIndex = labelText.lastIndexOf('-');
                labelText = labelText.substring(0, lastSpaceIndex - 1);
                $('#resultPlace').text(labelText);
            });


            //  ................


            var counter = 0;
            $('#addActivity').click(function(event) {
                event.preventDefault();
                counter++;
                var newDiv = $('<div>').addClass('item position-relative ps-4 ms-3');
                var h4 = $('<h4>').addClass('fs-5');
                var label = $('<label>', {
                    for: 'appt',
                    text: 'AT '
                });
                var inputTime = $('<input>', {
                    type: 'time',
                    id: 'time',
                    name: 'time[]'
                });
                var p = $('<p>').addClass('act');
                var inputText = $('<input>', {
                    type: 'text',
                    id: 'fname',
                    name: 'activity[]'
                });

                h4.append(label, inputTime);
                p.append(inputText);
                newDiv.append(h4, p);
                // newDiv.append($('<br><br>'));

                $('#container').append(newDiv, $('<br>'));
                $('#numberOfActivity').val(counter + "");

            });

            $('#removeActivity').click(function(event) {
                event.preventDefault();
                if (counter > 1)
                    counter--;
                $('#container').children().last().remove();
                $('#container').children().last().remove();
                $('#numberOfActivity').val(counter + "");
            });

        });
    </script>
@endsection
