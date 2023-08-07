



<div id="showParticipantPop" class="showParticipantPop">
    <div id="wislist" class="wislist">

        <!-- <div id="register" calss="register"> -->
        <div id="wishlist-content" class="wishlist-content">
            <span class="close" onclick="closeShowParticipantPop()">&times;</span>
            <h3 class="container text-center">HIKERS List</h3>
            <p class="introfav container text-center">Hikers On Your Tour </p>
            <div class="itemsWishList">

                @if(count($showParticipant) > 0)
                    @for ($i = 0; $i < count($showParticipant) ; $i++)

                        <div class="itemWishList">
                            <img src="{{ asset('storage/'.$showParticipant[$i]->image) }}" alt="">
                            <div class="contentWish">
                                <p>
                                    {{$showParticipant[$i]->name }}
                                </p>
                                {{-- <button class="ok"><i class="fa-solid fa-heart "></i></button> --}}

                                <form method="post" action="{{ url('booking/removeByAdmin') }}">
                                    @csrf
                                    @method('delete')
                                    <input name="user_id" type="hidden" value="{{ $showParticipant[$i]->id }}">
                                    <input name="tour_id" type="hidden" value="{{ $tour->id }}">
                                    <input name="owner_id" type="hidden" value="{{Auth::id()}}">
                                    <button type="submit">remove</button>
                                </form>
                            </div>
                        </div>
                    @endfor

                @else
                    <p class="text-capitalize text-center">Oops ! There is no one yet</p>
                @endif
            </div>
        </div>
    </div>
</div>
