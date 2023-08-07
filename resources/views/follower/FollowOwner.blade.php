@if (count($allTourOwner) > 0)

    <section id="gallery" class="gallery">
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2>Owner Tour </h2>
                <p>Check <span>Owner Tour In YallaRehlla</span></p>
            </div>



            <section class="followers">
                <div class="followesInHome section-header container text-center " data-aos="fade-up" data-aos-delay="100">

                    {{-- {{ $allTourOwner }} --}}

                    <div class="row">
                        <div class="col-sm-12">
                            <div id="suggestFollower" class="owl-carousel">
                                @foreach ($allTourOwner as $owner)
                                    <div class="item-follower">
                                        <div class="shadow-effect">
                                            <img class="rounded-circle suggestFollower_inMain "
                                                src="{{ asset('storage/' . $owner->image) }} "alt="followImg">
                                            <p>{{ $owner->name }} </p>
                                        </div>

                                        <button type="submit" class="addFollower" onclick="login()">Follow</button>
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
