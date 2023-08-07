


@section('custom-css')
    <style>
        .popup-screen-weather {
            z-index: 3;
            position: fixed;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            /* width: 100%; */
            height: 100%;
            display: flex;
            /* justify-content: center; */
            align-items: center;
            visibility: hidden;
            transition: 0.001s ease;
            transition-property: visibility;
        }

        .popup-screen-weather.active {
            visibility: visible;
        }

        .popup-box-weather {
            position: relative;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            max-width: 900px;
            max-height: 400px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin: 20px;
            padding: 50px 40px;
            border-radius: 20px;
            box-shadow: 0 5px 25px rgb(0 0 0 / 20%);
            transform: scale(0);
            transition: 0.001s ease;
            transition-property: transform;
        }

        .popup-screen-weather.active .popup-box-weather {
            transform: scale(1);
        }

        .popup-box-weather h2 {
            font-size: 2.1em;
            font-weight: 800;
            margin-bottom: 20px;
        }

        .close-btn-weather {
            position: absolute;
            font-size: 1em;
            top: 0;
            right: 0;
            margin: 15px;
            cursor: pointer;
            opacity: 1;
            transition: 0.01s ease;
            transition-property: opacity;
            color: #ce1212;
            border-radius: 50%;
            width: 30px;
            height: 30px;
        }

        .close-btn-weather:hover {
            opacity: 0.5;
        }


        /* .weatherClass {

            box-sizing: border-box;
            background-color: #d3c9c9;
            margin: 10px auto;
            padding: 20px;
            text-align: center;
        } */



        .weather-forecast {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
        }

        .day-forecast {
            margin: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: center;
        }

        .day-name {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .day-icon img {
            width: 50px;
            height: 50px;
        }

        .day-temp {
            font-size: 16px;
            margin-top: 10px;
        }
    </style>
@endsection


    {{-- <div class="container">
        <section>
            <div class="sticky-list ">
                <a class="weather-icon" href="#">weather <i class="fa-solid
                    fa-cloud"></i></a>
            </div>
        </section>
    </div> --}}

    <!-- start popup-screen for Weather -->
    <section class="popup-screen-weather">
        <div class="popup-box-weather">
            <i class="fas fa-times close-btn-weather"></i>
            <h1> 5 Day Weather Forecast</h1>
            <div class="container ">
                <div class="weather-forecast"></div>
            </div>
        </div>
    </section>
    <!-- End popup-screen for Weather-->



@section('scripts')
    <script>
        const weatherA = document.querySelector(".Weather-icon");
        const popupScreen = document.querySelector(".popup-screen-weather");
        const popupBox = document.querySelector(".popup-box-weather");
        const closeBtn = document.querySelector(".close-btn-weather");



        weatherA.addEventListener("click", () => {
            popupScreen.classList.add("active");

            // Replace "API_KEY" with your API key
            var apiKeyy = "022af4c03de813dad4dc89a061c9bea6";
            // Replace "CITY" and "COUNTRY_CODE" with the city and country code you want to get the weather for
            var cityy = "Ramallah"; // from dataBase
            var countryCode =
                "COUNTRY_CODE"; ///////////////////////////////////////////////////////////////////////
            var api_Url = "https://api.openweathermap.org/data/2.5/forecast?q=" + cityy + "," + countryCode +
                "&appid=" + apiKeyy;

            fetch(api_Url)
                .then(response => response.json())
                .then(data_weather => {

                    const weatherForecast = document.querySelector('.weather-forecast');

                    // for (let i = 0; i <5; i++) {
                    //     weatherForecast.classList.remove("day-forecast");
                    // }

                    // Create a new div for each day's forecast
                    for (let i = 0; i < 5; i++) {
                        const dayForecast = document.createElement('div');
                        dayForecast.classList.add('day-forecast');
                        weatherForecast.appendChild(dayForecast);
                        // Get the date and time for this day's forecast
                        const date = new Date(data_weather.list[i * 8].dt * 1000);
                        const dayName = date.toLocaleDateString('en-US', {
                            weekday: 'long'
                        });
                        dayForecast.innerHTML += `<div class="day-name">${dayName}</div>`;
                        // Get the weather icon and temperature for this day's forecast
                        const iconUrl =
                            `http://openweathermap.org/img/w/${data_weather.list[i * 8].weather[0].icon}.png`;
                        dayForecast.innerHTML +=
                            `<div class="day-icon"><img src="${iconUrl}" alt="${data_weather.list[i * 8].weather[0].description}"></div>`;
                        dayForecast.innerHTML +=
                            `<div class="day-temp">${Math.round(data_weather.list[i * 8].main.temp - 273.15)}°C</div>`;
                    }
                })
                .catch(error => console.log(error));
        });

        closeBtn.addEventListener("click", () => {
            popupScreen.classList.remove("active");
            //Close the popup screen on click the close button.
            // //Create a cookie for a day (to expire within a day) on click the close button.
            // document.cookie = "WebsiteName=testWebsite; max-age=" + 24 * 60 * 60; //1 day = 24 hours = 24*60*60
        });
    </script>
@endsection

{{-- style="background-image: url('{{ asset('storage/' . $user->image) }}');"> --}}
