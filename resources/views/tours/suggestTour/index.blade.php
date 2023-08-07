<section class="SuggestSection" data-aos="fade-up" data-aos-delay="200">
    <div class="introSuggest text-center">
        <h4>Suggest Tour</h4>
        <p> Suggest Tour<span> To Be Available</span> As Soon !</p>

    </div>

    <div class="SuggestDescriotion d-flex justify-content-center">
        <img src="{{ asset('storage/BackgroundSuggest.gif') }}" alt="suggest">



        <div class="fillSuggest text-center">
            <h4 class="mt-5 suggestTour">Suggest Your Tour </h4>
            <div class="informationSuggest">

                <form action="{{ url('/suggest/store') }}" method="POST">
                    @csrf

                    <div class="d-flex justify-content-center mt-4 ">
                        <i class="fa-solid fa-location-dot locationIcon mt-2"></i>
                        <p class="dateSuggestP me-2"> Select City</p>

                        <select class="location" required name="city" id="Box">
                            @php
                                $myBoxName = 'city';
                            @endphp
                            @include('tours.place.City_ar')
                        </select><br><br>

                        {{-- <input class="dateForSuggest" type="text" name="city"
                            placeholder="Put the date that suits you" required><br><br> --}}
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        <i class=" fa-solid fa-location-dot locationIcon mt-2"></i>
                        <p class="locationP me-2">Select Location </p>
                        <select class="dateForSuggest" required name="destination" id="Box">
                            @php
                                $myBoxName = 'destination';
                            @endphp
                            @include('tours.place.allPlace_ar')
                        </select><br><br>
                        {{-- <input class="location" type="text" name="destination" placeholder="Enter Location"
                            required><br><br> --}}
                    </div>

                    <p class="mt-3 noteSuggest">Your proposed tour will appear to everyone registered on the YallaRehlla
                    </p>

                    <button class="suggestButton">Suggest Now </button>

                    <input type="hidden" value="{{$user->id}}" name= "user_id">
                </form>
                <br>

                <button class="suggestButton viewSuggetClient" onclick="suggestListPop()">View suggested clients'
                    tours </button>

                <div id="suggestListPop" class="suggestListPop">
                    <div id="suggestList" class="suggestList">

                        @if (count($AlltoursSuggest) == 0)
                            <div id="suggestList-content" class="suggestList-content">
                                <span class="close" onclick="closeSuggestListPop()">&times;</span>
                                <h3 class="container text-center">Suggested tours </h3>
                                <p class="introfav container text-center">support Tour to be available </p>
                                <img class="noSuggetTourItem"src="{{ asset('storage/BackgroundSuggest.gif') }} "
                                    alt="suggest">
                                <p class="text-capitalize">Be the first to suggest !</p>
                            </div>
                        @else
                            <div id="suggestList-content" class="suggestList-content">
                                <span class="close" onclick="closeSuggestListPop()">&times;</span>
                                <h3 class="container text-center">Suggested
                                    tours </h3>
                                <p class="introfav container text-center">support
                                    Tour to be available </p>

                                <div class="itemsSuggestList ">

                                    {{-- {{dd($OwnerForSuggest)}} --}}
                                    @for ($i = 0; $i < count($AlltoursSuggest); $i++)
                                        <div class="itemSuggestList d-flex justify-content-start">
                                            <img src="{{ asset('storage/' . $OwnerForSuggest[$i]->image) }}" alt>

                                            @if ($user->type == 'tour_owner')
                                                <a href="{{ url('curdTourWithPopCreateSuggest/'.$AlltoursSuggest[$i]->destination .'/'. $OwnerForSuggest[$i]->id) }}"
                                                    class="suggestApproved "> <i
                                                        class="fa-solid fa-clipboard-check"></i></a>
                                            @endif

                                            <div class="infoSuggestTour">
                                                <p class="mt-4 ms-1  ">Suggested by
                                                    : {{  $OwnerForSuggest[$i]->name }} </p>
                                                <!-- <br> -->
                                                <p class="cityLocationSuggest ">City
                                                    :{{ $AlltoursSuggest[$i]->city }} &nbsp;&nbsp; Location :
                                                    {{ $AlltoursSuggest[$i]->destination }}</p>

                                                <form method="post" action="{{ url('suggest/addLikeToSuggest') }}">
                                                    @csrf
                                                    <button class="suggestLike">
                                                        <i class="fa-solid fa-thumbs-up"></i></button>
                                                    {{-- <span> (6)   </span> --}}
                                                    <span> ({{ $numberForLikers[$i] }}) </span>
                                                    <input type="hidden" name="suggest_id"
                                                        value="{{ $AlltoursSuggest[$i]->id }}">
                                                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                                                </form>


                                            </div>
                                            <!-- <button class="suggestLike"> <i class="fa-solid fa-thumbs-up"></i></button><span >15 clients </span> -->

                                            <!-- <p>Batir Tour </p> -->
                                        </div>
                                    @endfor

                                </div>
                            </div>


                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>


</section>
