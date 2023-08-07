{{-- {{dd(Auth::id())}} --}}
@if (count($MyPost) > 0)
    @for ($i = 0; $i < count($MyPost); $i++)
        <div class="  col-sm-4 ">
            <img src="{{ asset('storage/' . $MyPost[$i]->image) }}" alt="post">
            <div class="colllll">
                <div class=" d-flex  ">
                    <p class="numberLikesPost ms-5"> {{ $numberOfLikersForMyPost[$i] }} like</p>

                    <button id="btn-WishList" class="wishlist likepost container d-flex">
                        <!-- <i class="fa-solid fa-user-plus AddUser"></i> -->
                        <i class="WishlistIcon  fa-solid fa-heart"> </i>
                    </button>
                    <br>
                </div>
                <p class="ms-5">{{ $MyPost[$i]->description }}</p>
            </div>
        </div>


    @endfor
@else
    <div class=" text-center justify-content-center">
        no post Yet <br>
    </div>
@endif

{{-- suggest/addLikeToSuggest --}}
