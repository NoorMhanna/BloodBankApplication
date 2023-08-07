

@if (count($RecommandationTour) > 0)

    <section id="available-tour" class="available-tour mt-5">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="title position-relative mb-3">
                    <h2 class="mt-2 text-center">Similar Tour</h2>
                    <p class="mt-2">You can<span> Book Now!</span> or view</p>
                </div>
            </div>

            <div class="owl-carousel" id="RecommandationTour">
                @for ($i = 0; count($RecommandationTour) > $i; $i++)
                    @php
                        $image = json_decode($RecommandationTour[$i]->images)[0];
                        // dd($image);
                    @endphp
                    <div class="tour-card">
                        <div class="tour-poster position-relative">
                            <div class="overflow-hidden">
                                <img src="{{ asset('storage/' . $image) }}" />
                                <button class="viewDetails"><a calss="link_ViewDetails" href="{{ url('tours/' . $RecommandationTour[$i]->id) }}">View Detials</a></button>

                            </div>
                            <img class="circleProfileImg" src="{{ asset('storage/' . $OwnerForRecommandationTour[$i]->image) }}"
                                alt="tourOwnerProfile" />
                        </div>
                        <div class="tour-info pt-5 p-2 py-3 text-center">
                            <a href="#">{{ $OwnerForRecommandationTour[$i]->name }}</a>
                            <h3>{{ $RecommandationTour[$i]->name }}</h3>
                            <div class="line"></div>

                            <div class="info d-flex justify-content-between">
                                <div class="icons">
                                    <span>
                                        <a class="fa-solid fa-heart-circle-plus"
                                            href="{{ url('/wishlist/add/' . $RecommandationTour[$i]->id) }}"></a>
                                    </span>
                                    <span>
                                        <a class="fa-solid fa-users" href=""></a>
                                        {{ $numberOfBookingInRecommandationTour[$i] }}
                                    </span>
                                </div>
                                <div class="price">{{ $RecommandationTour[$i]->price }} &#8362;
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>

        </div>


    </section>

@endif


