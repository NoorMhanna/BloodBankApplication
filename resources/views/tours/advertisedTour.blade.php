<div id="BookingPop" class="BookingPop" style="display: none">
    <div id="wislist" class="wislist">
        <!-- <div id="register" calss="register"> -->
        <div id="Booking-content" class="Booking-content">
            <span class="close" onclick="closeBookingPop()">&times;</span>
            <h3 class="container text-center">Tours Booking</h3>
            <p class="introfav container text-center">YOUR TOUR BOOKING</p>
            <div class="itemsBookingList">
                {{-- $ --}}
                {{-- {{dd($myRegistredTour)}} --}}
                @if (count($myRegistredTour) > 0)
                    @for ($i = 0; $i < count($myRegistredTour); $i++)
                        @php
                        // dd($myRegistredTour);
                            $image = json_decode($myRegistredTour[$i]->images)[0];
                        @endphp
                        <div class="itemBooking">
                            <img src="{{ asset('storage/' . $image) }}" alt="">
                            <div class="contentWish">
                                <p>{{ $myRegistredTour[$i]->name }}</p>
                                {{-- <i class="fa-solid fa-heart "></i> --}}
                                <p class="LocationWishlist"><span>Location : {{ $myRegistredTour[$i]->source }}
                                    Departure: {{ $myRegistredTour[$i]->destination }}</span></p>
                                <p class="peiceINwishlist"> {{ $myRegistredTour[$i]->price }} &#8362 </p>

                                <form method="POST" action="{{url('booking/remove')}}">
                                    @csrf
                                    @method('delete')
                                    <button>Cancel reservation</button>
                                    <input type="hidden" name="tour_id" value="{{ $myRegistredTour[$i]->id }}">
                                </form>
                            </div>
                        </div>
                    @endfor
                @else
                    <p>You do not have any of the tours booked!</p>
                @endif

            </div>
        </div>
    </div>

</div>
