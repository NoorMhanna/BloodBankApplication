    <div id="note" class="note">
        <!-- the content start show  -->
        <div id="notefication" class="noteficationPop">

            <div id="notefication-content" class="notefication-content">
                <span class="close" onclick="closenote()">&times;</span>
                <h3 class="container text-center">Notefication</h3>

                <div>
                    <p class="introfav container text-center">Check Last your notifications</p>
                </div>


                @if (count($notefication) > 0)


                    <div class="itemsnotefication">
                        <!-- <button> -->

                        @for ($i = 0; count($notefication) > $i; $i++)
                            @if ($notefication[$i]->type == 'Rank')
                                @php
                                    $msg = json_decode($notefication[$i]->note)->msg;
                                @endphp
                                <div class="itemNotefication">
                                    <img src="{{ asset('storage/rank.png') }}" alt="rank">
                                    {{-- <i class="viewFeedback fa-solid fa-ranking-star"></i> --}}
                                    <p class="nonteText">{{ $msg }}.</p>
                                </div>
                            @elseif ($notefication[$i]->type == 'friend')
                                @php
                                    $frindRequest = json_decode($notefication[$i]->note)->friend;
                                    // $name = $frindRequest->name;
                                    // dd($frindRequest->name);
                                @endphp
                                <div class="itemNotefication">
                                    <img src="{{ 'storage/' . $frindRequest->image }}" alt="">
                                    <i class=" addFriend fa-solid fa-user-plus"></i>
                                    <p class="nonteText">{{ $frindRequest->name }} wants to follow you</p>
                                    <br><br>
                                    <form method="post" action="{{ url('/follow/add') }}">
                                        @csrf
                                        <input type="hidden" name="not_id" value="{{ $notefication[$i]->id }}">
                                        <input type="hidden" name="following" value="false">
                                        <input type="hidden" name="friend_id" value="{{ Auth::id() }}">


                                        <button class="followRequest acceptBtn">Accept</button>
                                    </form>
                                    <form method="post" action="{{ url('/follow/remove') }}">
                                        <input type="hidden" name="not_id" value="{{ $notefication[$i]->id }}">
                                        <button class="followRequest deleteBtn">Delete</button>
                                    </form>
                                </div>
                            @elseif ($notefication[$i]->type == 'suggest')
                                @php
                                    $msg = json_decode($notefication[$i]->note)->msg;
                                @endphp
                                <div class="itemNotefication">
                                    <img src="{{ asset('storage/BackgroundSuggest.gif') }}" alt="suggestImg">
                                    <i class=" notefication_In_NotefecstionList  fa-solid fa-bell"></i>
                                    <p class="nonteText">{{ $msg }}.check it!</p>
                                </div>
                            @elseif ($notefication[$i]->type == 'Drop_regester')
                                @php
                                    $msg = json_decode($notefication[$i]->note)->msg;
                                @endphp
                                <div class="itemNotefication">
                                    {{-- <img src="{{ asset('storage/BackgroundSuggest.gif') }}" alt="suggestImg"> --}}
                                    {{-- <i class=" notefication_In_NotefecstionList  fa-solid fa-bell"></i> --}}
                                    <p class="nonteText">{{ $msg }}.check it!</p>
                                </div>
                            @elseif ($notefication[$i]->type == 'Drop_suggest')
                                @php
                                    $msg = json_decode($notefication[$i]->note)->msg;
                                @endphp
                                <div class="itemNotefication">
                                    {{-- <img src="{{ asset('storage/BackgroundSuggest.gif') }}" alt="suggestImg"> --}}
                                    {{-- <i class=" notefication_In_NotefecstionList  fa-solid fa-bell"></i> --}}
                                    <p class="nonteText">{{ $msg }}.check it!</p>
                                </div>
                            @endif
                        @endfor

                    </div>
                @else
                    <div class="justify-content-center">
                        <img class="noItemInWishList " src="{{ asset('storage/noNotification.png') }}"
                            alt="no itwm in wishList">
                        <p class="text-capitalize text-center">No Notification List ! </p>
                    </div>


                @endif
            </div>
        </div>
    </div>
