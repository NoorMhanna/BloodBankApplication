@if (count($availableTours) > 0)

    <section id="available-tour" class="available-tour mt-5">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="title position-relative mb-3">
                    <h2 class="mt-2 text-center">Available Tour</h2>
                    <p class="mt-2">You can<span> Book Now!</span></p>
                </div>
            </div>

            <div class="d-flex justify-content-center">

                <form id="filterForm" method="post" action="{{url('filterToursAsPrice')}}">
                    @csrf
                    <div class="range container ">
                        <div class="sliderValue">
                            <span class="spanbud" id="spanbud">50</span>
                            <button type="submit">Filter Tours</button>
                        </div>
                        <div class="field">
                            <div class="value left">50</div>
                            <input class="inputtt" name="price" id="price" type="range" min="50" max="500"
                                value="50" steps="1">
                            <div class="value right">500</div>
                        </div>
                    </div>
                </form>

                <div class="container">
                    <form method="POST" action="{{url('filterToursAsCity')}}" id="filterCity" class="d-flex PuttingActivity">
                        @csrf
                        <div class="input-group">
                            <input name="inputCity" name="destination" class="form-control jjj shar_profile me-2 ml-auto p-3"
                                placeholder="Search for the city you are interested in it ">
                            <button class="addActivity" type="submit"><i class="fa-solid fa-plus"></i></button>
                        </div>
                    </form>
                </div>

            </div>

            <br>

            <div class="owl-carousel" id="AvaliableToursCarousel">
                @for ($i = 0; count($availableTours) > $i; $i++)
                    @php
                        $image = json_decode($availableTours[$i]->images)[0];
                        // dd($image);
                    @endphp
                    <div class="tour-card">
                        <div class="tour-poster position-relative">
                            <div class="overflow-hidden">
                                <img src="{{ asset('storage/' . $image) }}" />
                                <button class="viewDetails"><a calss="link_ViewDetails"
                                        href="{{ url('tours/' . $availableTours[$i]->id) }}">View Detials</a></button>
                                {{-- <a href="{{ url('tours/' . $availableTours[$i]->id) }}" class="main-btn btn-card">View --}}
                                {{-- Details</a> --}}
                            </div>
                            <img class="circleProfileImg" src="{{ asset('storage/' . $OwnerForAvailable[$i]->image) }}"
                                alt="tourOwnerProfile" />
                        </div>
                        <div class="tour-info pt-5 p-2 py-3 text-center">
                            <a
                                href="{{ url('users/AnyProfile/' . $OwnerForAvailable[$i]->id) }}">{{ $OwnerForAvailable[$i]->name}}</a>

                            <a href="{{ url('tours/' . $availableTours[$i]->id) }}">
                                <h3>{{ $availableTours[$i]->name }}</h3>
                            </a>
                            <div class="line"></div>

                            <div class="info d-flex justify-content-between">
                                <div class="icons">
                                    <span>
                                        <a href="{{ url('/wishlist/add/' . $availableTours[$i]->id) }}"><i
                                                class="fa-solid fa-heart-circle-plus"></i></a>
                                    </span>
                                    <span>
                                        <i class="fa-solid fa-users" href="#"></i>
                                        {{ $numberOfBookingInForAvailable[$i] }}
                                    </span>
                                </div>
                                <div class="price">{{ $availableTours[$i]->price }} &#8362;
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </section>



@endif

@section('scripts')
    {{-- <script>
        $(document).ready(function() {
            const filterForm = $('#filterForm');
            const budgetInput = $('#inputtt');
            const selectedBudget = $('#spanbud');
            const toursList = $('#AvaliableToursCarousel');

            filterForm.submit(function(event) {
                event.preventDefault();
                const budget = budgetInput.val();

                $.ajax({
                    type: 'POST',
                    url: '{{ route('filterTours_price') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        price: budget
                    },
                    dataType: 'json',
                    success: function(response) {
                        toursList.empty(); // Clear existing tours
                        const ownerForAvailable = @json($OwnerForAvailable);
                        const numberOfBookingInForAvailable = @json($numberOfBookingInForAvailable);



                        // Loop through the filtered tours and append them to the toursList div
                        $.each(response, function(index, tour) {
                            const images = JSON.parse(tour.images);
                            const firstImage = images[0];
                            const dataItem = `
        <div class="tour-card">
            <div class="tour-poster position-relative">
                <div class="overflow-hidden">
                    <img src="{{ asset('storage') }}/${firstImage}" />
                    <a href="{{ url('tours/') }}/${tour.id}" class="main-btn btn-card">View Details</a>
                </div>
                <img class="circleProfileImg" src="{{ asset('storage') }}/${ownerForAvailable[index].image}"
                    alt="tourOwnerProfile" />
            </div>
            <div class="tour-info pt-5 p-2 py-3 text-center">
                <a href="#">${ownerForAvailable[index].name}</a>
                <h3>${tour.name}</h3>
                <div class="line"></div>
                <div class="info d-flex justify-content-between">
                    <div class="icons">
                        <span>
                            <a class="fa-solid
                fa-heart-circle-plus "
                                href="{{ url('/wishlist/add') }}/${tour.id}"></a>
                        </span>
                        <span>
                            <a class="fa-solid fa-users" href=""></a>
                            ${numberOfBookingInForAvailable[index] }
                        </span>
                    </div>
                    <div class="price"></div>
                    ${tour.price}&#8362;
                </div>
            </div>
        </div>
                `;


                            toursList.append(dataItem);
                        });
                        selectedBudget.text(budget); // Update selected budget display
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            });

            budgetInput.on('input', function() {
                selectedBudget.text(budgetInput.val());
            });
        });
    </script> --}}

    {{-- <script>
        $(document).ready(function() {
            const filterForm = $('#filterCity');
            const CityInput = $('#inputCity').val();
            const toursList = $('#AvaliableToursCarousel');

            filterForm.submit(function(event) {
                event.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: '{{ route('filterTours_city') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        cityName: CityInput
                    },
                    dataType: 'json',
                    success: function(response) {
                        toursList.empty(); // Clear existing tours
                        const ownerForAvailable = @json($OwnerForAvailable);
                        const numberOfBookingInForAvailable = @json($numberOfBookingInForAvailable);



                        // Loop through the filtered tours and append them to the toursList div
                        $.each(response, function(index, tour) {
                            const images = JSON.parse(tour.images);
                            const firstImage = images[0];
                            const dataItem = `
    <div class="tour-card">
        <div class="tour-poster position-relative">
            <div class="overflow-hidden">
                <img src="{{ asset('storage') }}/${firstImage}" />
                <a href="{{ url('tours/') }}/${tour.id}" class="main-btn btn-card">View Details</a>
            </div>
            <img class="circleProfileImg" src="{{ asset('storage') }}/${ownerForAvailable[index].image}"
                alt="tourOwnerProfile" />
        </div>
        <div class="tour-info pt-5 p-2 py-3 text-center">
            <a href="#">${ownerForAvailable[index].name}</a>
            <h3>${tour.name}</h3>
            <div class="line"></div>
            <div class="info d-flex justify-content-between">
                <div class="icons">
                    <span>
                        <a class="fa-solid
            fa-heart-circle-plus "
                            href="{{ url('/wishlist/add') }}/${tour.id}"></a>
                    </span>
                    <span>
                        <a class="fa-solid fa-users" href=""></a>
                        ${numberOfBookingInForAvailable[index] }
                    </span>
                </div>
                <div class="price"></div>
                ${tour.price}&#8362;
            </div>
        </div>
    </div>
            `;


                            toursList.append(dataItem);
                        });
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            });
        });
    </script> --}}
@endsection
