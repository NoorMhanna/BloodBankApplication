<section id="more-Details-Tour">
    <div class=" container allDetails text-center">
        <h2>More Details</h2>
        <p>view more for <span>{{ $tour->name }} Tour !</span> </p>
    </div>
</section>
<!-- start Detials for Tour -->


<section class="Viewdetails d-flex justify-content-around " data-aos="fade-up" data-aos-delay="200" id="">

    <div class="infoTourDetails">
        <div class=" text-center name-Tour">
            <p>{{ $tour->name }}</p>
        </div>

        <div class="detailesInfo">
            <div class="fullDetailsTour justify-content">

                @php
                    $allActivity = json_decode($tour->ActivityAndTime);
                    $countTime = count($allActivity) / 2;
                @endphp


                <div class="Day-Date d-flex justify-content-center" style="margin-left: -15%">
                    <i class="DateIcone  fa-solid fa-calendar-days ms-4 mt-4"></i>
                    <p class="ms-5 mt-4"> <span>Date : {{ $tour->dateOFTour }}</span></p>

                </div>
                <div class=" TimeStart d-flex justify-content-center" style="margin-left: -30%">
                    <i class=" DateIcone fa-regular fa-money-bill-1  ms-4 mt-4"></i>
                    <p class="ms-5 mt-4">Price :
                        {{ $tour->price }} &#8362 </p>
                </div>

                @php
                    $currentDate = Carbon\Carbon::now();
                    $futureDate = $currentDate->addDays(7);
                    $dateTour = Carbon\Carbon::parse($tour->dateOFTour);
                @endphp

                @if ($futureDate > $dateTour && $tour->available == 1)
                    <div class=" WishList d-flex justify-content-center">
                        <i class=" WeatherInDetails fa-solid fa-cloud-sun ms-4 mt-4 "></i>
                        <button id="weatherBUTN" onclick="weatherPop()"
                            class="WishList-In-Details weather-icon Join-In-Details  ms-4 mt-4 ">Weather
                        </button>
                    </div>
                @endif


                <div class="shareTour d-flex justify-content-center">
                    <i class=" shareTourindetailsIcon fa-solid fa-arrow-up-from-bracket ms-4  mt-4 "></i>
                    <button id="copyUrlButton" class="shareTourindetails Join-In-Details  ms-4 mt-4 "> Share your
                        friends </button>
                </div>


                @if ($status == 0)
                    <div class=" Booking d-flex justify-content-center mt-3">
                        <form method="POST" action="{{ url('booking/add') }}">
                            @csrf

                            @if ($user->type == 'tour_owner')
                                <i onclick="showParticipantPop()"
                                    class="memberpartcipateIcon fa-solid fa-users-line ms-3 mt-1 "> <br><span
                                        class="ms-3">{{ count($showParticipant) }}</span></i>
                            @else
                                <i class="memberpartcipateIcon fa-solid fa-users-line ms-3 mt-1 "> <br><span
                                        class="ms-3">{{ count($showParticipant) }}</span></i>
                            @endif

                            <button class="Join-In-Details WishList-In-Details ms-3 "> Join Now </button>
                            <input type="hidden" name="tour_id" value="{{ $tour->id }}">
                        </form>
                    </div>
                @else
                    <div class=" Booking d-flex justify-content-center mt-3">
                        <form method="POST" action="{{ url('booking/remove') }}">
                            @csrf
                            @method('delete')
                            <i class=" memberpartcipateIcon fa-solid fa-users-line mt-1 ms-3 "> <br><span
                                    class="ms-3">{{ count($showParticipant) }}</span></i>
                            <button class="Join-In-Details WishList-In-Details ms-3 "> Cancel reservation </button>
                            <input type="hidden" name="tour_id" value="{{ $tour->id }}">
                        </form>
                    </div>
                @endif

                @if ($ifFavorite == 0)
                    <div class=" WishList d-flex justify-content-center">
                        <form method="get" action="{{ url('wishlist/add/' . $tour->id) }}">
                            @csrf
                            <i class=" Add-WishListIcon fa-solid fa-heart-circle-plus ms-4  mt-4 "></i>
                            <button class="WishList-In-Details Join-In-Details  ms-4 mt-4 "> Add Tour To wish list
                            </button>
                        </form>
                    </div>
                    <br>
                @else
                    <div class=" WishList d-flex justify-content-center">
                        <form method="get" action="{{ url('wishlist/delete/' . $tour->id) }}">
                            @csrf
                            <i class=" Add-WishListIcon fa-solid fa-heart-circle-plus ms-4  mt-4 "></i>
                            <button class="WishList-In-Details Join-In-Details  ms-4 mt-4 "> Remove Tour From WishList
                            </button>
                        </form>
                    </div>
                @endif

            </div>
        </div>

    </div>
    <div class="steps-Tour">
        <div class=" d-flex justify-content-around">
            <div class="content-step">
                <p class="text-capitalize"> <i class="fa-brands fa-medapps ms-1 mt-2 "></i><span>
                        our Activities</span></p>

                <div class="Activity">
                    @for ($i = 0; count($allActivity) / 2 > $i; $i++, $countTime++)
                        <div class="item position-relative ps-4 ms-3">
                            <h4 class="fs-5">At
                                {{ $allActivity[$countTime] }}
                            </h4>
                            <p style="color: #ce1212">{{ $allActivity[$i] }}</p>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>


    <div class="mapInDtials" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
        <div id="map"></div>
    </div>

</section>
<!-- end Detials for Tour -->

{{-- <section class="container d-flex">
    <i class="fas fa-times close-btn"></i>
    <h1> 6 Day Weather Forecast</h1>
    <div class="container d-flex">

        @foreach ($weather as $data)
            <div class=" col-md-3 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="weather-forecast ">
                            <div class="day-forecast">
                                <div class="day-name">
                                    <h5 class="card-title">{{ date('D, M j', strtotime($data['dt_txt'])) }}</h5>
                                </div>
                                <div class="day-icon">
                                    <img class="weather-icon"
                                        src="http://openweathermap.org/img/w/{{ $data['weather'][0]['icon'] }}.png"
                                        alt="Weather Icon">
                                </div>
                                <div class="day-temp">
                                    <p class="card-text">{{ $data['main']['temp'] }} &#8451;</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        @endforeach
    </div>
</section> --}}

<div id="weatherPop" class="weatherPop" style="display: none">
    <!-- <div id="register" calss="register"> -->
    <div id="weather-contenrt" class="weather-contenrt">
        <span class="close" onclick="closeWeatherPop()">&times;</span>
        <h3 class="container text-center">6 Day Weather Forecast</h3>
        <div class="itemsWearther">


            @foreach ($weather as $data)
            <div class="itemWeather">
                <div class=" day-forecast ">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="day-name">
                                <h5 class="card-title">{{ date('D, M j', strtotime($data['dt_txt'])) }}</h5>
                            </div>
                            <div class="day-icon">
                                <img class="weather-icon"
                                src="http://openweathermap.org/img/w/{{ $data['weather'][0]['icon'] }}.png"
                                alt="Weather Icon">
                            </div>
                            <div class="day-temp">
                                <p class="card-text">{{ $data['main']['temp'] }} &#8451;</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>

    </div>
</div>
