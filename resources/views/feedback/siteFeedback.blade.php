

@if (count($feedbacks) > 0)
    <section class="feedbacksection">
        <div class="feedback section-header container text-center " data-aos="fade-up" data-aos-delay="100">
            <h2>What People Say </h2>
            <p>How real people said about<span> YallaRehlla</span> </p>
            <div class="row">
                <div class="col-sm-12">
                    <div id="people-testimonials" class="owl-carousel">

                        @for ($i = 0; $i < count($feedbacks); $i++)
                            <div class="item-feedbcak">
                                <div class="shadow-effect">
                                    <img class="rounded-circle" src="{{ asset('storage/' . $users[$i]->image) }}" alt>
                                    <p>{{ $feedbacks[$i]->comment }}</p>
                                </div>
                                <div class="testimonial-name">{{ $feedbacks[$i]->name }}</div>
                            </div>
                        @endfor


                    </div>
                </div>
            </div>
        </div>
    </section>

@endif
