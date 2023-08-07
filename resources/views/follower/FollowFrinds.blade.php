@if (count($frinds) > 0)

    <section id="gallery" class="gallery">
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2>friends </h2>
                <p>Check <span>Friends Suggested In YallaRehlla</span></p>
            </div>



            <section class="followers">
                <div class="followesInHome section-header container text-center " data-aos="fade-up" data-aos-delay="100">

                    {{-- {{ $allTourOwner }} --}}

                    <div class="row">
                        <div class="col-sm-12">
                            <div id="suggestFollower" class="owl-carousel">
                                @foreach ($frinds as $frind)
                                    <div class="item-follower">
                                        <a href="{{ url("users/AnyProfile/$frind->id") }}">
                                            <div class="shadow-effect">
                                                <img class="rounded-circle suggestFollower_inMain"
                                                    src="{{ asset('storage/' . $frind->image) }} "alt="followImg">
                                                <p>{{ $frind->name }} </p>
                                            </div>
                                        </a>

                                        <form action="{{ url('follow/add') }}" method="post">
                                            @csrf
                                            {{-- <input name="user_id" type="hidden" value="{{}}"> --}}
                                            {{-- <input name="friend_id" type="hidden" value="2"> --}}
                                            <input type="hidden" name="following" value="true">
                                            <input type="hidden" name="friend_id" value="{{ $frind->id }}">
                                            <button type="submit" class="addFollower">Follow</button>

                                        </form>
                                    </div>
                                    <!--END OF TESTIMONIAL 1 -->
                                @endforeach

                            </div>
                        </div>
                    </div>

                </div>
            </section>
        </div>
    </section><!-- End Gallery Section -->

@endif
