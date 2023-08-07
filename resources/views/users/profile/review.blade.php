<div id="reviewPop" class="reviewPop" style="display: none">
    <div id="wislist" class="wislist">

        <!-- <div id="register" calss="register"> -->
        <div id="review_content" class="review_content">
            <span class="close" onclick="closereviewPop()">&times;</span>
            <h3 class="container text-center">Review</h3>

            <p class="introfav container text-center">LOOK TO YOUR Feedback</p>

            <div class="content_review ">
                <img class="feedbackImgintro reviewPage " src="{{ asset('storage/Feedback.gif') }}"
                    alt="feedback image">
                <div class="d-flex justify-content-center mt-2">

                    <button id="btn-lookfeedbackWeb" class=" shareTourindetails Join-In-Details  btn-lookfeedbackWeb mt-2 ms-3 text-capitalize"
                        onclick="prevFeedback()">feedback tours
                    </button>
                    <div id="prevFeedback" class="prevFeedback">
                        <div>
                            <div id="prevFeedback-content" class="prevFeedback-content">
                                <span class="close" onclick="closeprevFeedback()">&times;</span>
                                <h3 class="container text-center">Feedback </h3>
                                <p class="introPrev container text-center"> your
                                    Previous tours with YallaRehlla </p>
                                <!-- client feedback -->
                                <div class="PrevFeedbackperson ">
                                    @include('feedback.myFeedback')
                                </div>


                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
