{{-- {{dd($Following)}} --}}
@if (count($Following) > 0)
    <div id="following_in_profilePOP" class="following_in_profilePOP" style="display: none">
        <div id="folloewrs" class="followers">

            <!-- <div id="register" calss="register"> -->
            <div id="following-content" class="following-content">
                <span class="close" onclick="closefollowingPop()">&times;</span>
                <h3 class="container text-center">Following</h3>
                <p class="introfav container text-center">All Following </p>
                <div class="itemFollower">
                    @for ($i = 0; $i < count($Following); $i++)
                        <div class="itemFollowingList">
                            <img src="{{ asset('storage/' . $Following[$i]->image) }}" alt="">
                            <div class="contentFollower">
                                <p class="nameUser">
                                    {{ $Following[$i]->name }}
                                </p>

                                {{-- @if ($user->id == Auth::id())
                                    <form action="follow/remove" method="post">
                                        @csrf
                                        <button> Remove </button>
                                        <input name="user_id" type="hidden" value="{{ Auth::id()}}">
                                        <input name="frind_id" type="hidden" value="{{ $Following[$i]->id}}">
                                    </form>
                                @else --}}
                                    <button id="ShowProfile" data-id="{{ $Following[$i]->id }}"> Show Profile </button>
                                {{-- @endif --}}

                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
@else
    <div id="following_in_profilePOP" class="following_in_profilePOP">
        <div id="folloewrs" class="followers">
            <div id="following-content" class="following-content">
                <span class="close" onclick="closefollowingPop()">&times;</span>
                <h3 class="container text-center">Following</h3>
                <p class="introfav container text-center">All Following </p>
                <div class=" text-center justify-content-center">
                    no following
                </div>
            </div>
        </div>
    </div>
@endif
