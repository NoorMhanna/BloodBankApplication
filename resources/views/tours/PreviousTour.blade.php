


@if (count($previousTours) > 0)

    <section id="available-tour" class="available-tour mt-5">
        <div class="container">

            <div class="d-flex justify-content-center">
                <div class="title position-relative mb-3">
                    <h2 class="mt-2 text-center">Previous Tour</h2>
                    <p class="mt-2">You can<span> view previous Tours!</span></p>
                </div>
            </div>

            <br>

            <div class="owl-carousel" id="previousToursCarousel">
                @for ($i = 0; count($previousTours) > $i; $i++)
                    @php
                        $image = json_decode($previousTours[$i]->images)[0];
                        // dd($image);
                    @endphp
                    <div class="tour-card">
                        <div class="tour-poster position-relative">
                            <div class="overflow-hidden">
                                <img src="{{ asset('storage/' . $image) }}" />
                                <button class="viewDetails"><a calss="link_ViewDetails"
                                        href="{{ url('tours/' . $previousTours[$i]->id) }}">View Detials</a></button>
                                {{-- <a href="{{ url('tours/' . $availableTours[$i]->id) }}" class="main-btn btn-card">View --}}
                                {{-- Details</a> --}}
                            </div>
                            <img class="circleProfileImg" src="{{ asset('storage/' . $OwnerForpreviousTours[$i]->image) }}"
                                alt="tourOwnerProfile" />
                        </div>
                        <div class="tour-info pt-5 p-2 py-3 text-center">
                            <a
                                href="{{ url('users/AnyProfile/' . $OwnerForpreviousTours[$i]->id) }}">{{ $OwnerForpreviousTours[$i]->name }}</a>

                            <a href="{{ url('tours/' . $previousTours[$i]->id) }}">
                                <h3>{{ $previousTours[$i]->name }}</h3>
                            </a>
                            <div class="line"></div>

                            <div class="info d-flex justify-content-between">
                                <div class="icons">
                                    <span>
                                        <a href="{{ url('/wishlist/add/' . $previousTours[$i]->id) }}"><i
                                                class="fa-solid fa-heart-circle-plus"></i></a>
                                    </span>
                                    <span>
                                        <i class="fa-solid fa-users" href="#"></i>
                                        {{ $numberOfBookingInForpreviousTours[$i] }}
                                    </span>
                                </div>
                                <div class="price">{{ $previousTours[$i]->price }} &#8362;
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </section>



@endif
