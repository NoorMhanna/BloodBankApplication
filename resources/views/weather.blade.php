{{-- <!DOCTYPE html>
<html>
<head>
    <title>7-Day Weather Forecast for {{ $city }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-4">7-Day Weather Forecast for {{ $city }}</h1>
        <div class="row mt-4">
            @foreach ($forecast as $data)
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ date('D, M j', strtotime($data['dt_txt'])) }}</h5>
                            <p class="card-text">Temperature: {{ $data['main']['temp'] }} &#8451;</p>
                            <p class="card-text">Description: {{ $data['weather'][0]['description'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html> --}}


{{-- <!DOCTYPE html>
<html>

<head>
    <title>6-Day Weather Forecast for {{ $city }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/weather-icons/2.0.10/css/weather-icons.min.css">
</head>

<body>
    <div class="container">
        <h1 class="mt-4">7-Day Weather Forecast for {{ $city }}</h1>
        <div class="row mt-4">
            @foreach ($uniqueForecast as $data)
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ date('D, M j', strtotime($data['dt_txt'])) }}</h5>
                            <i class="wi wi-owm-{{ $data['weather'][0]['id'] }}"></i>
                            <p class="card-text">Temperature: {{ $data['main']['temp'] }} &#8451;</p>
                            <p class="card-text">Description: {{ $data['weather'][0]['description'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>

</html> --}}


<!DOCTYPE html>
<html>

<head>
    <title>7-Day Weather Forecast for {{ $city }}</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include OpenWeatherMap icons CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/weather-icons/2.0.10/css/weather-icons.min.css">
    {{-- <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            padding-top: 50px;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .card-title {
            font-size: 24px;
            font-weight: bold;
            color: #007bff; /* Blue color */
        }
        .card-text {
            font-size: 18px;
            color: #333; /* Dark gray color */
        }
        .weather-icon {
            font-size: 48px;
            color: #ffc107; /* Yellow color */
        }
    </style> --}}
</head>

<body>
    <div class="container">

        <section class="popup-screen-weather active">
            <div class="popup-box-weather">
                <i class="fas fa-times close-btn"></i>
                <h1> 6 Day Weather Forecast</h1>
                <div class="container d-flex">
                    @foreach ($uniqueForecast as $data)
                    {{dd($uniqueForecast)}}
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
                                                {{-- <p class="card-text">Description: {{ $data['weather'][0]['description'] }} --}}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>




</body>

</html>
