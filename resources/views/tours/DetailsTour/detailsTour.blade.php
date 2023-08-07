@extends('layout')

@section('custom-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
    {{-- <link rel="stylesheet" href="{{ asset('css/tailwind.output.css')}} " /> --}}

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        #map {
            height: 600px;
            width: 400px;
        }
    </style>
@endsection

@section('title')
    Details - {{ $tour->name }}
@endsection


@section('contant')
    <!-- ======= Header ======= -->
    @include('navBar')
    <!-- End Header -->
    @include('tours.showParticipant')

    <main>
        <section>
            <div class="main-div ">

                <div class="container identy-Company d-flex justify-content-start">
                    <img class="rounded-circle owner-img " src="{{ asset('storage/' . $owner->image) }}"
                        alt="owner tour image">
                    <p class="p-3">
                        {{($owner->name)}}
                    </p>
                </div>

                <div class="content-Tour justify-content-center">

                    {{-- informationsTour --}}
                    @include('tours.DetailsTour.informationsTour')


                    {{-- more Details --}}
                    @include('tours.DetailsTour.moreDetails')


                    <!-- start Discriptipn section  -->
                    <section id="DescriptionSectinInDetails" data-aos="fade-up" data-aos-delay="200">
                        @php
                            $short_description = json_decode($tour->short_description);
                        @endphp

                        <p class=" text-center descriptionP">Description </p>
                        <div class=" d-flex justify-content-evenly descriptionPart ">
                            @for ($i = 0; count($short_description) > $i; $i++)
                                <p class="typeTourDescriptionDetails">{{ $short_description[$i] }}</p>
                            @endfor
                        </div>
                        <p class="fullDescriptionInDetails"><span>Description : </span> {{ $tour->description }}</p>
                    </section>

                    @if ($tour->available == 0)
                        <!-- start feedback section -->
                        @include('tours.DetailsTour.feedback')
                    @endif

                    {{--  --}}
                    @include('tours.DetailsTour.recommendation')

                </div>
            </div>
        </section>
    </main>
    @php
        $FinalPath = json_decode($tour->path);
    @endphp
@endsection


@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([{{ $FinalPath[0]->latitude }}, {{ $FinalPath[0]->longitude }}], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
            maxZoom: 15,
        }).addTo(map);


        //marker
        var placesData = @json($FinalPath);

        for (var i = 0; i < placesData.length; i++) {
            var place = placesData[i];
            L.marker([place.latitude, place.longitude]).addTo(map).bindPopup(place.place);

            // // Add path
            if (i > 0) {
                var prevPlace = placesData[i - 1];
                var latlngs = [
                    [prevPlace.latitude, prevPlace.longitude],
                    [place.latitude, place.longitude]
                ];
                L.polyline(latlngs, {
                    color: 'red'
                }).addTo(map);
            }
        }
    </script>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Button click event handler
        document.getElementById("copyUrlButton").addEventListener("click", function() {
            // Get the page URL
            var pageUrl = window.location.href;

            // Create a temporary input element to copy the URL
            var tempInput = document.createElement("input");
            tempInput.value = pageUrl;
            document.body.appendChild(tempInput);

            // Select and copy the URL
            tempInput.select();
            tempInput.setSelectionRange(0, 99999); // For mobile devices
            document.execCommand("copy");

            // Clean up: remove the temporary input element
            document.body.removeChild(tempInput);

            // Show some visual feedback that the URL has been copied (optional)
            alert("URL copied to clipboard: " + pageUrl + "\nshare it with your friends on Yallarehla side and with other");
        });
    });
</script>


@endsection
