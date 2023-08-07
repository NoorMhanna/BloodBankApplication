<section id="feedbackSectinInDetails" data-aos="fade-up" data-aos-delay="200">
    <div class=" container feedbackPart">
        <h4 class=" text-center">Clients Feedback </h4>
        <p class=" introfeedback text-center">Leave Your <span>Mark !</span> </p>
        <div class="d-flex justify-content-around">

            <img class="feedbackImgintro " src="{{ asset('storage/Feedback.gif') }}" alt="feedback image">

            <!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores illo dolorem distinctio veritatis ipsam tempore, inventore doloremque similique quibusdam atque voluptate quae nobis minima itaque ducimus excepturi eius natus provident.</p> -->
            <div class="feedbackIntroContant">
                <div class="introfeebckInDetails">
                    <p class="text-center mt-5 feedbackInDetails">Feedback </p>
                    <p class="ms-3 text-capitalize pargeaphInteroFeedback">Your feedback helps YallaRehlla
                        in the development process.Thank you for your time,
                        we appreciate it.</p>
                </div>
                <div class="d-flex justify-content-center">
                    @if (count($feedBackForTour) != 0)
                        <button id="btn-lookfeedback" class="btn-lookfeedback mt-2 ms-3 text-capitalize"
                            onclick="prevFeedback()">Look At Feedback
                        </button>
                        <div id="prevFeedback" class="prevFeedback">
                            <div>
                                <div id="prevFeedback-content" class="prevFeedback-content">
                                    <span class="close" onclick="closeprevFeedback()">&times;</span>
                                    <h3 class="container text-center">Feedback </h3>
                                    <p class="introPrev container text-center">Previous feedback from
                                        clients
                                    </p>
                                    <div class="PrevFeedbackperson ">
                                        @for ($i = 0; count($feedBackForTour) > $i; $i++)
                                            <div class="itemPrevFeedbackperson  d-flex justify-content-start">
                                                <img class="mt-4 mb-4"src="{{ asset('storage/' . $users_feedBack[$i]->image) }}"
                                                    alt="">
                                                <!-- <button class="suggestApproved "><i class="fa-solid fa-clipboard-check"></i></button> -->
                                                <div class="infoFeedbackTour ">
                                                    <p class="mt-4 ms-3 mb-2  ">Feedback by :
                                                        {{ $users_feedBack[$i]->name }} </p>
                                                    <!-- ============================should cheack======================== -->
                                                    <p class="ms-3 mb-1 ">Review rating :
                                                        @for ($j = 0; $feedBackForTour[$i]->star > $j; $j++)
                                                            <span class="fa fa-star checked"></span>
                                                        @endfor
                                                    </p>
                                                    <p class="ms-3">comment :
                                                        {{ $feedBackForTour[$i]->comment }}</p>
                                                </div>
                                                <!-- <button class="suggestLike"> <i class="fa-solid fa-thumbs-up"></i></button><span >15 clients </span> -->

                                                <!-- <p>Batir Tour </p> -->
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                        </div>

                        <br>
                        @if ($status == 1)
                            <p class="mt-4 ms-3">OR</p>
                        @endIf

                    @endif

                    {{-- {{$status}} --}}
                    @if ($status == 1)
                        <button id="btn-feedback" class="btn-feedback mt-2 ms-3 me-3 text-capitalize"
                            onclick="feedback()">Add your feedBack
                        </button>
                    @endif

                    @if (count($feedBackForTour) == 0 && $status == 0)
                        <button id="btn-feedback" class="btn-feedback mt-2 ms-3 me-3 text-capitalize">no feedback
                            yet</button>
                    @endif



                    <form action="/feedback/store" method="post">
                        @csrf

                        <div id="feedbackRating" class="feedbackRating">
                            <div id="feedback-content" class="feedback-content">
                                <span class="close" onclick="closeFeedback()">&times;</span>
                                <!-- <div id="register" calss="register"> -->
                                <!-- <div id="" class=""> -->
                                <h3 class="container text-center givefeedback">Give feedback</h3>
                                <p class="container text-center feedbackexperance">We appreciate feedback
                                    about your experiance . </p>
                                <p class="text-center recommedCompany"> How likely are you to recommend
                                    <span>{{ $owner->name }} </span> other ?
                                </p>
                                <div class="rating d-flex justify-content-center">
                                    <input type="radio" id="star5" name="rating" value="5" />
                                    <label class="fa fa-star rateFeedback" for="star5" title="5 stars"></label>
                                    <input type="radio" id="star4" name="rating" value="4" />
                                    <label class="fa fa-star rateFeedback " for="star4" title="4 stars"></label>
                                    <input type="radio" id="star3" name="rating" value="3" />
                                    <label class="fa fa-star rateFeedback " for="star3" title="3 stars"></label>
                                    <input type="radio" id="star2" name="rating" value="2" />
                                    <label class="fa fa-star rateFeedback" for="star2" title="2 stars"></label>
                                    <input type="radio" id="star1" name="rating" value="1" />
                                    <label class="fa fa-star rateFeedback" for="star1" title="1 star"></label>
                                </div>
                                <p class="ms-5 mt-2 LikelyORNot">Not Likely ---------------------------
                                    Very
                                    Likely </p>
                                <p class="pBoXfeedback">What are the main reasons for your rating ? </p>
                                <textarea required name="comment" class="textfeedback ms-2 container justify-content-center"></textarea>
                                <p class="text-center noteprivet">We'll Share Your Feedback With
                                    YallaRehlla
                                </p>
                                <div class=" mt-2 d-flex justify-content-end ">
                                    <input type="hidden" name="tour_id" value="{{ $tour->id }}">
                                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                    <button class="SubAndCancel">Submit </button>
                                    <button class=" SubAndCancel  ms-3">Cancel </button>
                                </div>
                                <!-- </div> -->

                            </div>
                        </div>

                    </form>


                </div>
            </div>
        </div>
    </div>
</section>
