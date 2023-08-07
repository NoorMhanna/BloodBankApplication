//to make line under every active section
document.addEventListener("DOMContentLoaded", () => {
    "use strict";

    let navbarlinks = document.querySelectorAll("#navbar a");

    function navbarlinksActive() {
        navbarlinks.forEach((navbarlink) => {
            let section = document.querySelector(navbarlink.hash);
            if (!section) return;

            let position = window.scrollY + 200;

            if (
                position >= section.offsetTop &&
                position <= section.offsetTop + section.offsetHeight
            ) {
                navbarlink.classList.add("active");
            } else {
                navbarlink.classList.remove("active");
            }
        });
    }
    window.addEventListener("load", navbarlinksActive);
    document.addEventListener("scroll", navbarlinksActive);

    /**
     * Scroll top button for end to begin
     */
    const scrollTop = document.querySelector(".scroll-top");
    if (scrollTop) {
        const togglescrollTop = function () {
            window.scrollY > 100
                ? scrollTop.classList.add("active")
                : scrollTop.classList.remove("active");
        };
        window.addEventListener("load", togglescrollTop);
        document.addEventListener("scroll", togglescrollTop);
        scrollTop.addEventListener(
            "click",
            window.scrollTo({
                top: 0,
                behavior: "smooth",
            })
        );
    }

    /**
     * Initiate glightbox to make the pic open and move to another
     */
    /////////////////////
    const glightbox = GLightbox({
        selector: ".glightbox",
    });

    new Swiper(".gallery-slider", {
        speed: 400, //
        loop: true,
        centeredSlides: true, //to make the show slide in the middel
        autoplay: {
            delay: 5000, //to anothe one
        },

        slidesPerView: 6,
        spaceBetween: 50,
    });
});
let valueDisplays = document.querySelectorAll(".num");
let interval = 5000;

valueDisplays.forEach((valueDisplay) => {
    let startValue = 0;
    let endValue = parseInt(valueDisplay.getAttribute("data-val"));
    let duration = Math.floor(interval / endValue);
    let counter = setInterval(function () {
        startValue += 1;
        valueDisplay.textContent = startValue;
        if (startValue == endValue) {
            clearInterval(counter);
        }
    }, duration);
});

jQuery(document).ready(function ($) {
    "use strict";
    //  TESTIMONIALS CAROUSEL HOOK
    $("#people-testimonials").owlCarousel({
        loop: true,
        center: true,
        items: 3,
        margin: 0,
        autoplay: true,
        dots: true,
        autoplayTimeout: 8500,
        smartSpeed: 450,
        responsive: {
            0: {
                items: 1,
            },
            768: {
                items: 2,
            },
            1170: {
                items: 3,
            },
        },
    });
});
jQuery(document).ready(function ($) {
    "use strict";
    //  TESTIMONIALS CAROUSEL HOOK
    $("#suggestFollower").owlCarousel({
        loop: true,
        center: true,
        items: 5,
        margin: 0,
        autoplay: true,
        dots: true,
        autoplayTimeout: 8500,
        smartSpeed: 450,
        responsive: {
            0: {
                items: 1,
            },
            768: {
                items: 3,
            },
            1170: {
                items: 5,
            },
        },
    });
});

$(document).ready(function () {
    $("#previousToursCarousel").owlCarousel();
});

$("#previousToursCarousel").owlCarousel({
    loop: true,
    margin: 10,
    nav: true,
    responsive: {
        0: {
            items: 1,
        },
        600: {
            items: 2,
        },
        1000: {
            items: 5,
        },
    },
});

$(document).ready(function () {
    $("#AvaliableToursCarousel").owlCarousel();
});

$("#AvaliableToursCarousel").owlCarousel({
    loop: true,
    margin: 10,
    nav: true,
    responsive: {
        0: {
            items: 1,
        },
        600: {
            items: 2,
        },
        1000: {
            items: 5,
        },
    },
});

$(document).ready(function () {
    $("#RecommandationTour").owlCarousel();
});

$("#RecommandationTour").owlCarousel({
    loop: true,
    margin: 10,
    nav: true,
    responsive: {
        0: {
            items: 1,
        },
        600: {
            items: 2,
        },
        1000: {
            items: 5,
        },
    },
});

// to budget
const sliderValue = document.querySelector("#spanbud");
const inputSlider = document.querySelector("#inputtt");
inputSlider.oninput = () => {
    let value = inputSlider.value;
    sliderValue.textContent = value;
    sliderValue.style.left = value / 5 + "%";
    sliderValue.classList.add("show");
};
inputSlider.onblur = () => {
    sliderValue.classList.remove("show");
};

// ______________________________________________________________________________________________
//pop
// ______________________________________________________________________________________________

function closenote() {
    document.getElementById("note").style.display = "none";
}

function note() {
    document.getElementById("note").style.display = "block";
}
function suggestListPop() {
    document.getElementById("suggestListPop").style.display = "block";
}

function closeSuggestListPop() {
    document.getElementById("suggestListPop").style.display = "none";
}
function addToursPop() {
    document.getElementById("addToursPop").style.display = "block";
}

function closeaddToursPop() {
    document.getElementById("addToursPop").style.display = "none";
}

function prevFeedback() {
    document.getElementById("prevFeedback").style.display = "block";
}
function closeprevFeedback() {
    document.getElementById("prevFeedback").style.display = "none";
}

function showParticipantPop() {
    document.getElementById("showParticipantPop").style.display = "block";
}
function closeShowParticipantPop() {
    document.getElementById("showParticipantPop").style.display = "none";
}

function wishListPop() {
    document.getElementById("wishListPop").style.display = "block";
}
function closewishListPop() {
    document.getElementById("wishListPop").style.display = "none";
}

function advertisedTourPop() {
    document.getElementById("advertisedTourPop").style.display = "block";
}
function closeAdvertisedTourPop() {
    document.getElementById("advertisedTourPop").style.display = "none";
}

function addUser() {
    document.getElementById("addUser").style.display = "block";
}

function closeAddUser() {
    document.getElementById("addUser").style.display = "none";
}

function login() {
    document.getElementById("login").style.display = "block";
    document.getElementById("contentsignUp").style.display = "none";
}

function closeLogin() {
    document.getElementById("login").style.display = "none";
    document.getElementById("contentsignUp").style.display = "none";
}
function signIn() {
    document.getElementById("login-content").style.display = "none";
    document.getElementById("contentsignUp").style.display = "block";
    // document.getElementById("login").style.display = "none";
}

function closeSignIn() {
    document.getElementById("contant").style.display = "none";
    document.getElementById("contentsignUp").style.display = "none";
    document.getElementById("login-content").style.display = "block";
    document.getElementById("login").style.display = "none";
}

function editMainAdminPop() {
    document.getElementById("editMainAdminPop").style.display = "block";
}

function closeeditMainAdminPop() {
    document.getElementById("editMainAdminPop").style.display = "none";
}

function editProfilePop() {
    document.getElementById("editProfilePop").style.display = "block";
}

function closeedProfilePop() {
    document.getElementById("editProfilePop").style.display = "none";
}

function createPostPop() {
    document.getElementById("createPostPop").style.display = "block";
}

function closeedcreatePostPop() {
    document.getElementById("createPostPop").style.display = "none";
}

function EditTourPop() {
    document.getElementById("EditTourPop").style.display = "block";
}

function closeedEditTourPop() {
    document.getElementById("EditTourPop").style.display = "none";
}

function editUserInfoPop(user) {
    document.getElementById("editUserInfoPop").style.display = "block";
}

function closeedEditUserInfoPop() {
    document.getElementById("editUserInfoPop").style.display = "none";
}



function weatherPop() {
    document.getElementById("weatherPop").style.display = "block";
}

function closeWeatherPop() {
    document.getElementById("weatherPop").style.display = "none";
}



function loadView() {
    axios
        .get("{{ route('login') }}")
        .then(function (response) {
            document.getElementById("login").innerHTML = response.data;
        })
        .catch(function (error) {
            console.log(error);
        });
}

function follower_in_profilePOP() {
    document.getElementById("follower_in_profilePOP").style.display = "block";
}

function closefollowerPop() {
    document.getElementById("follower_in_profilePOP").style.display = "none";
}
function following_in_profilePOP() {
    document.getElementById("following_in_profilePOP").style.display = "block";
}

function BookingPop() {
    document.getElementById("BookingPop").style.display = "block";
}
function closeBookingPop() {
    document.getElementById("BookingPop").style.display = "none";
}
function closefollowingPop() {
    document.getElementById("following_in_profilePOP").style.display = "none";
}

function reviewPop() {
    document.getElementById("reviewPop").style.display = "block";
}
function closereviewPop() {
    document.getElementById("reviewPop").style.display = "none";
}
function closeEdite_personalInfoPOP() {
    document.getElementById("edite_personalInfoPOP").style.display = "none";
}
function edite_personalInfoPOP() {
    document.getElementById("edite_personalInfoPOP").style.display = "block";
}

function feedback() {
    document.getElementById("feedbackRating").style.display = "block";
}

function closeFeedback() {
    document.getElementById("feedbackRating").style.display = "none";
}
// ______________________________________________________________________________________________
//pop
// ______________________________________________________________________________________________
