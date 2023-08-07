<section class="map ">
    <div class="text-center introNearTour">
        <h4>All Tours</h4>
        <p>Look to The <span>Nearest</span> Available Tours</p>
    </div>


    @section('custom-css')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.css" />
        <style>
            #map {
                height: 400px;
                width: 1500px;
            }
        </style>
    @endsection


    <div class="container" id="map"></div>

    {{-- @section('scripts') --}}
    <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([31.9038, 35.2035], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
            maxZoom: 18,
        }).addTo(map);

        // Array of markers
        var tourMarkers = {!! json_encode($allTours) !!};
        // console.log(markers[0]);




        tourMarkers.forEach(function(tour) {
        var marker = L.marker([tour.latitude, tour.longitude]).addTo(map);
        marker.bindPopup(tour.name);

        marker.on('click', function() {
            // Redirect to a new page when the marker is clicked
            window.location.href = '/tours/' + tour.id; // Replace 'tour.id' with the actual tour ID or any URL you want to navigate to.
        });
    });

        // AIzaSyD0eMyBrdIHdjVl96RXDr2La_a5qS8KbO8 .. short Path ..
    </script>
    {{-- @endsection --}}
</section>
