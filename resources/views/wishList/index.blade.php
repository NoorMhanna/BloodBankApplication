<div id="wishListPop" class="wishListPop">
    <div id="wislist" class="wislist">

        <!-- <div id="register" calss="register"> -->
        <div id="wishlist-content" class="wishlist-content">
            <span class="close" onclick="closewishListPop()">&times;</span>
            <h3 class="container text-center">WishList</h3>
            <p class="introfav container text-center">Your favorite tours </p>



                @if (count($listWishListTour) > 0)
                    @for ($i = 0; $i < count($listWishListTour); $i++)

                        <div class="itemWishList">

                            <img src="{{ asset('storage/' . json_decode($listWishListTour[$i]->images)[0]) }}"
                                alt="">
                            <div class="contentWish">
                                <p>
                                    {{ $listWishListTour[$i]->name }}
                                </p>
                                <form method="post" action="{{ url('wishlist/delete') }}">
                                    @csrf
                                    @method('delete')
                                    <input name="tour_id" type="hidden" value="{{ $listWishListTour[$i]->id }}">
                                    <input name="user_id" type="hidden" value="{{ $user->id }}">
                                    <a href="{{ url('wishlist/delete/' . $listWishListTour[$i]->id) }}"><i
                                            class="fa-solid fa-heart "></i></a>
                                </form>
                                <p class="LocationWishlist"><span>Location: {{ $listWishListTour[$i]->destination }}
                                        place Departure: {{ $listWishListTour[$i]->source }}</span></p>
                                <button><a href="{{url('tours/'.$listWishListTour[$i]->id)}}">Show</a></button>
                            </div>
                        </div>
                    @endfor
                @endif

        </div>
    </div>
</div>
