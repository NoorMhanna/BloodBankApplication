@if (count($Followers) > 0)
    {{-- {{dd($Followers) }} --}}

    <div id="follower_in_profilePOP" class="follower_in_profilePOP" style="display: none">
        <div id="folloewrs" class="followers">
            <div id="follower-content" class="follower-content">
                <span class="close" onclick="closefollowerPop()">&times;</span>
                <h3 class="container text-center">followres</h3>
                <p class="introfav container text-center">All friends </p>
                <div class="itemFollower">
                    @for ($i = 0; $i < count($Followers); $i++)
                        <div class="itemFollowerList">
                            <img src="{{ asset('storage/' . $Followers[$i]->image) }}" alt="">
                            <div class="contentFollower">
                                <p class="nameUser">
                                    {{ $Followers[$i]->name }}
                                </p>

                                {{-- @if ($user->id == Auth::id())
                                    <form action="follow/remove" method="post">
                                        @csrf
                                        <button> Remove </button>
                                        <input name="user_id"  type="hidden" value="{{ $Followers[$i]->id }}">
                                        <input name="frind_id" type="hidden" value="{{ Auth::id() }}">
                                    </form>
                                @else --}}
                                    <button id="ShowProfile" data-id="{{ $Followers[$i]->id }}"> Show Profile </button>
                                {{-- @endif --}}



                            </div>
                        </div>
                    @endfor

                </div>
            </div>
        </div>
    </div>
@else
    <div id="follower_in_profilePOP" class="follower_in_profilePOP">
        <div id="folloewrs" class="followers">
            <div id="follower-content" class="follower-content">
                <span class="close" onclick="closefollowerPop()">&times;</span>
                <h3 class="container text-center">followres</h3>
                <p class="introfav container text-center">All friends </p>
                <div class=" text-center justify-content-center">
                    no Follower
                </div>
            </div>
        </div>
    </div>

@endif
