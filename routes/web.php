<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\WebBriefController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\SuggestTourController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
// path .. conrtoller .. function
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware('guest')->group(function () {

    Route::get('/main', [UserController::class, 'main'])->name('/main');

    //sigup:
    Route::get('/signUp', [UserController::class, 'signUpForm'])->name('/signUp');
    Route::post('/signUp', [UserController::class, 'signUp'])->name('/signUp');

    //login
    Route::get('/login', [UserController::class, 'loginForm'])->name('/login');
    Route::post('/login', [UserController::class, 'login'])->name('/login');

    // Route::get('/filterTours', [TourController::class, 'filterByBudget'])->name('/filterTours');
});


Route::group(['middleware' => ['admin']], function () {

    // -------------------------------------- users: -----------------------------------
    Route::get('/users/curdUsersToEditUser/{id}', [HomeController::class, 'curdUsersToEditUser'])->name('/users.curdUsersToEditUser');
    Route::delete('users/delete/{id}', [UserController::class, 'delete'])->name('/users.delete');
    Route::get('/curdUsers', [HomeController::class, 'curdUsers'])->name('/curdUsers');
    Route::put('/updateTypeUser', [UserController::class, 'updateType'])->name('/brief.update');


    // -------------------------------------- brief -----------------------------------
    Route::put('/brief/update', [WebBriefController::class, 'update'])->name('/brief.update');

    // -------------------------------------- service -----------------------------------(for next ... )
    Route::get('/service', [ServiceController::class, 'index'])->name('/service.index');
    Route::get('/service/show', [ServiceController::class, 'show'])->name('/service.show');
    Route::get('/service/create', [ServiceController::class, 'create'])->name('/service.create');
    Route::post('/service/store', [ServiceController::class, 'store'])->name('/service.store');
    Route::delete('service/delete', [ServiceController::class, 'destroy'])->name('/service.delete');
    Route::get('/service/edit/{id}', [ServiceController::class, 'edit'])->name('/service.edit');
    Route::put('/service/update', [ServiceController::class, 'update'])->name('/service.update');
});



Route::group(['middleware' => ['tourOwner']], function () {

    // -------------------------------------- Tours: -----------------------------------
    //feedback:
    Route::delete('/feedback/delete', [FeedbackController::class, 'destroy'])->name('/feedback.delete');

    //create:
    Route::post('/tours/store', [TourController::class, 'store'])->name('/tours.store');
    Route::delete('/tours/delete', [TourController::class, 'delete'])->name('/tours.delete');
    Route::put('/tours/update', [TourController::class, 'update'])->name('/tours.update');

    Route::get('/curdTours', [TourController::class, 'curdTour'])->name('/curdTours');
    // Route::get('/curdTourWithPop/{city}/{id}', [TourController::class, 'curdTourWithPop'])->name('/curdTourWithPop');
    Route::get('/CurdWithPopCreate', [TourController::class, 'curdTourWithPopCreate'])->name('/CurdWithPopCreate');
    Route::get('/CurdWithPopUpdate/{id}', [TourController::class, 'curdTourWithPopUpdate'])->name('/CurdWithPopUpdate');

    // Route::get('/CurdWithPop', [TourController::class, 'curdTourWithPopCreate'])->name('/CurdWithPop');

    //take suggest ..
    Route::get('/curdTourWithPopCreateSuggest/{city}/{idSuggerster}', [TourController::class, 'curdTourWithPopCreateSuggest'])->name('/curdTourWithPopCreateSuggest');
});

Route::middleware('auth')->group(function () {

    // -------------------------------------- Home -----------------------------------
    Route::get('/home', [HomeController::class, 'home'])->name('/home');
    Route::get('/', [HomeController::class, 'home'])->name('/home');

    // -------------------------------------- logout -----------------------------------
    Route::get('/logout', [UserController::class, 'logout'])->name('/logout');

    // -------------------------------------- users -----------------------------------
    Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('/edit'); /// ??????????????????????? with out id ..
        Route::put('/update', [UserController::class, 'update'])->name('/update');

        // -------------------------------------- Profile -----------------------------
        // Route::get('/profile/{id}', [UserController::class, 'profile'])->name('/profile');
        // Route::get('/profile/edit/{id}', [UserController::class, 'editProfile']);
        // Route::get('/post/create', [UserController::class, 'createPost']);
        Route::post('/post/store', [UserController::class, 'storePost']);
        Route::get('/showAllFeedBack', [UserController::class, 'showAllFeedBack']); // ... need pop ...
        Route::get('/AnyProfile/{id}', [UserController::class, 'PublicProfile'])->name('/PublicProfile');
    });


    // -------------------------------------- feedback For tour -------------------------
    Route::post('/feedback/store', [FeedbackController::class, 'store'])->name('/feedback.store');
    Route::get('/feedback/edit/{id}', [FeedbackController::class, 'edit'])->name('/feedback.edit');
    Route::put('/feedback/update', [FeedbackController::class, 'update'])->name('/feedback.update');


    // -------------------------------------- Wishlist - crud -----------------------------------
    Route::get('/wishlist/{id}', [WishlistController::class, 'index'])->name('/wishlist');
    Route::get('/wishlist/add/{id}', [WishlistController::class, 'add'])->name('/wishlist.add');
    Route::get('/wishlist/delete/{id}', [WishlistController::class, 'destroy'])->name('/wishlist.delete');


    // -------------------------------------- Tour -----------------------------------
    Route::get('/tours/{id}', [TourController::class, 'ShowDetailsForTour']);
    // Route::get('/tours/cord/{id}', [TourController::class, 'getCoordinates']);
    Route::get('/map', [MapController::class, 'showMap']);


    Route::get('/tours/availableTour', [TourController::class, 'ShowAvailableTour'])->name('/tours.availableTour');
    Route::get('/tours/previousTour', [TourController::class, 'previousTour'])->name('/tours.previousTour');
    // Route::get('/tours/check/{id}', [TourController::class, 'checkAvailable'])->name('/tours.checkAvailable');
    Route::get('/filterTours', [TourController::class, 'filterByBudget'])->name('/filterTours');

    // Route::post('/tours/openTocreatePath', [TourController::class, 'openTocreatePath']);
    // Route::post('/tours/createpath', [TourController::class, 'createpath']);


    // Route::get('/tours/search/{id}', [TourController::class, 'searchByPrice'])->name('/tours.search');
    Route::get('/tours/searchByCity/{id}', [TourController::class, 'searchByCity'])->name('/tours.searchByCity');
    Route::get('/tours/searchByPrice/{id}', [TourController::class, 'searchByPrice'])->name('/tours.searchByPrice');
    Route::get('/tours/searchByDate/{id}', [TourController::class, 'searchByDate'])->name('/tours.searchByDate');
    Route::get('/tours/searchByCompany/{id}', [TourController::class, 'searchByCompany'])->name('/tours.searchByCompany');
    Route::get('/filterTours', [TourController::class, 'filterByBudget'])->name('/filterTours');


    // -------------------------------------- suggest Tour -----------------------------------
    Route::post('/suggest/store', [SuggestTourController::class, 'storeSuggestTour'])->name('/tours.suggestTour.store');
    Route::delete('/suggest/remove', [SuggestTourController::class, 'DropSuggestTour'])->name('/tours.suggestTour.remove');
    // Route::get('/suggest/destroy/{id}', [SuggestTourController::class, 'destroy'])->name('/tours.suggestTour.destroy');
    Route::post('/suggest/addLikeToSuggest', [SuggestTourController::class, 'addLiker'])->name('/tours.suggestTour.addLiker');


    // -------------------------------------- Folow: -----------------------------------
    Route::get('/follow', [FollowerController::class, 'index'])->name('/follow');
    Route::post('/follow/add', [FollowerController::class, 'add'])->name('/follow.add');
    Route::delete('/follow/remove', [FollowerController::class, 'remove'])->name('/follow.remove');
    Route::post('/showFolowing', [UserController::class, 'showFolowing'])->name('/follow.showFolowing');
    Route::post('/showFolower', [FollowerController::class, 'showFolower'])->name('/follow.showFolower');


    // -------------------------------------- Booking: -----------------------------------
    Route::get('/booking', [BookController::class, 'index'])->name('/booking');
    Route::post('/booking/add', [BookController::class, 'add'])->name('/booking.add');
    Route::delete('/booking/remove', [BookController::class, 'remove'])->name('/booking.remove');
    Route::delete('/booking/removeByAdmin', [BookController::class, 'removeByAdmin'])->name('/booking.removeByAdmin');
    Route::post('/booking/showParticipant', [TourController::class, 'showParticipant'])->name('/booking.showParticipant');



    Route::get('/tours', [TourController::class, 'index']);
    Route::post('/filterToursAsPrice', [HomeController::class, 'filterToursAsPrice'])->name('filterTours_price');
    Route::post('/filterToursAsCity', [HomeController::class, 'filterToursAsCity'])->name('filterTours_city');
});






Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
    Route::get('/curdUsers', [HomeController::class, 'curdUsers'])->name('/curdUsers');

    Route::middleware('guest')->group(function () {

        Route::get('/main', [UserController::class, 'main'])->name('/main');

        //sigup:
        Route::get('/signUp', [UserController::class, 'signUpForm'])->name('/signUp');
        Route::post('/signUp', [UserController::class, 'signUp'])->name('/signUp');

        //login
        Route::get('/login', [UserController::class, 'loginForm'])->name('/login');
        Route::post('/login', [UserController::class, 'login'])->name('/login');

        // Route::get('/filterTours', [TourController::class, 'filterByBudget'])->name('/filterTours');
    });


    Route::group(['middleware' => ['admin']], function () {

        // -------------------------------------- users: -----------------------------------
        Route::get('/users/curdUsersToEditUser/{id}', [HomeController::class, 'curdUsersToEditUser'])->name('/users.curdUsersToEditUser');
        Route::delete('users/delete/{id}', [UserController::class, 'delete'])->name('/users.delete');
        // Route::get('/curdUsers', [HomeController::class, 'curdUsers'])->name('/curdUsers');
        Route::put('/updateTypeUser', [UserController::class, 'updateType'])->name('/brief.update');


        // -------------------------------------- brief -----------------------------------
        Route::put('/brief/update', [WebBriefController::class, 'update'])->name('/brief.update');

        // -------------------------------------- service -----------------------------------(for next ... )
        Route::get('/service', [ServiceController::class, 'index'])->name('/service.index');
        Route::get('/service/show', [ServiceController::class, 'show'])->name('/service.show');
        Route::get('/service/create', [ServiceController::class, 'create'])->name('/service.create');
        Route::post('/service/store', [ServiceController::class, 'store'])->name('/service.store');
        Route::delete('service/delete', [ServiceController::class, 'destroy'])->name('/service.delete');
        Route::get('/service/edit/{id}', [ServiceController::class, 'edit'])->name('/service.edit');
        Route::put('/service/update', [ServiceController::class, 'update'])->name('/service.update');
    });



    Route::group(['middleware' => ['tourOwner']], function () {

        // -------------------------------------- Tours: -----------------------------------
        //feedback:
        Route::delete('/feedback/delete', [FeedbackController::class, 'destroy'])->name('/feedback.delete');

        //create:
        Route::post('/tours/store', [TourController::class, 'store'])->name('/tours.store');
        Route::delete('/tours/delete', [TourController::class, 'delete'])->name('/tours.delete');
        Route::put('/tours/update', [TourController::class, 'update'])->name('/tours.update');

        Route::get('/curdTours', [TourController::class, 'curdTour'])->name('/curdTours');
        // Route::get('/curdTourWithPop/{city}/{id}', [TourController::class, 'curdTourWithPop'])->name('/curdTourWithPop');
        Route::get('/CurdWithPopCreate', [TourController::class, 'curdTourWithPopCreate'])->name('/CurdWithPopCreate');
        Route::get('/CurdWithPopUpdate/{id}', [TourController::class, 'curdTourWithPopUpdate'])->name('/CurdWithPopUpdate');

        // Route::get('/CurdWithPop', [TourController::class, 'curdTourWithPopCreate'])->name('/CurdWithPop');

        //take suggest ..
        Route::get('/curdTourWithPopCreateSuggest/{city}/{idSuggerster}', [TourController::class, 'curdTourWithPopCreateSuggest'])->name('/curdTourWithPopCreateSuggest');
    });

    Route::middleware('auth')->group(function () {

        // -------------------------------------- Home -----------------------------------
        Route::get('/home', [HomeController::class, 'home'])->name('/home');
        Route::get('/', [HomeController::class, 'home'])->name('/home');

        // -------------------------------------- logout -----------------------------------
        Route::get('/logout', [UserController::class, 'logout'])->name('/logout');

        // -------------------------------------- users -----------------------------------
        Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
            Route::get('/edit/{id}', [UserController::class, 'edit'])->name('/edit'); /// ??????????????????????? with out id ..
            Route::put('/update', [UserController::class, 'update'])->name('/update');

            // -------------------------------------- Profile -----------------------------
            // Route::get('/profile/{id}', [UserController::class, 'profile'])->name('/profile');
            // Route::get('/profile/edit/{id}', [UserController::class, 'editProfile']);
            // Route::get('/post/create', [UserController::class, 'createPost']);
            Route::post('/post/store', [UserController::class, 'storePost']);
            Route::get('/showAllFeedBack', [UserController::class, 'showAllFeedBack']); // ... need pop ...
            Route::get('/AnyProfile/{id}', [UserController::class, 'PublicProfile'])->name('/PublicProfile');
        });


        // -------------------------------------- feedback For tour -------------------------
        Route::post('/feedback/store', [FeedbackController::class, 'store'])->name('/feedback.store');
        Route::get('/feedback/edit/{id}', [FeedbackController::class, 'edit'])->name('/feedback.edit');
        Route::put('/feedback/update', [FeedbackController::class, 'update'])->name('/feedback.update');


        // -------------------------------------- Wishlist - crud -----------------------------------
        Route::get('/wishlist/{id}', [WishlistController::class, 'index'])->name('/wishlist');
        Route::get('/wishlist/add/{id}', [WishlistController::class, 'add'])->name('/wishlist.add');
        Route::get('/wishlist/delete/{id}', [WishlistController::class, 'destroy'])->name('/wishlist.delete');


        // -------------------------------------- Tour -----------------------------------
        Route::get('/tours/{id}', [TourController::class, 'ShowDetailsForTour']);
        // Route::get('/tours/cord/{id}', [TourController::class, 'getCoordinates']);
        Route::get('/map', [MapController::class, 'showMap']);


        Route::get('/tours/availableTour', [TourController::class, 'ShowAvailableTour'])->name('/tours.availableTour');
        Route::get('/tours/previousTour', [TourController::class, 'previousTour'])->name('/tours.previousTour');
        // Route::get('/tours/check/{id}', [TourController::class, 'checkAvailable'])->name('/tours.checkAvailable');
        Route::get('/filterTours', [TourController::class, 'filterByBudget'])->name('/filterTours');

        // Route::post('/tours/openTocreatePath', [TourController::class, 'openTocreatePath']);
        // Route::post('/tours/createpath', [TourController::class, 'createpath']);


        // Route::get('/tours/search/{id}', [TourController::class, 'searchByPrice'])->name('/tours.search');
        Route::get('/tours/searchByCity/{id}', [TourController::class, 'searchByCity'])->name('/tours.searchByCity');
        Route::get('/tours/searchByPrice/{id}', [TourController::class, 'searchByPrice'])->name('/tours.searchByPrice');
        Route::get('/tours/searchByDate/{id}', [TourController::class, 'searchByDate'])->name('/tours.searchByDate');
        Route::get('/tours/searchByCompany/{id}', [TourController::class, 'searchByCompany'])->name('/tours.searchByCompany');
        Route::get('/filterTours', [TourController::class, 'filterByBudget'])->name('/filterTours');


        // -------------------------------------- suggest Tour -----------------------------------
        Route::post('/suggest/store', [SuggestTourController::class, 'storeSuggestTour'])->name('/tours.suggestTour.store');
        Route::delete('/suggest/remove', [SuggestTourController::class, 'DropSuggestTour'])->name('/tours.suggestTour.remove');
        // Route::get('/suggest/destroy/{id}', [SuggestTourController::class, 'destroy'])->name('/tours.suggestTour.destroy');
        Route::post('/suggest/addLikeToSuggest', [SuggestTourController::class, 'addLiker'])->name('/tours.suggestTour.addLiker');


        // -------------------------------------- Folow: -----------------------------------
        Route::get('/follow', [FollowerController::class, 'index'])->name('/follow');
        Route::post('/follow/add', [FollowerController::class, 'add'])->name('/follow.add');
        Route::delete('/follow/remove', [FollowerController::class, 'remove'])->name('/follow.remove');
        Route::post('/showFolowing', [UserController::class, 'showFolowing'])->name('/follow.showFolowing');
        Route::post('/showFolower', [FollowerController::class, 'showFolower'])->name('/follow.showFolower');


        // -------------------------------------- Booking: -----------------------------------
        Route::get('/booking', [BookController::class, 'index'])->name('/booking');
        Route::post('/booking/add', [BookController::class, 'add'])->name('/booking.add');
        Route::delete('/booking/remove', [BookController::class, 'remove'])->name('/booking.remove');
        Route::delete('/booking/removeByAdmin', [BookController::class, 'removeByAdmin'])->name('/booking.removeByAdmin');
        Route::post('/booking/showParticipant', [TourController::class, 'showParticipant'])->name('/booking.showParticipant');



        Route::get('/tours', [TourController::class, 'index']);
        Route::post('/filterToursAsPrice', [HomeController::class, 'filterToursAsPrice'])->name('filterTours_price');
        Route::post('/filterToursAsCity', [HomeController::class, 'filterToursAsCity'])->name('filterTours_city');
    });

});


// Route::get('/weather/{city}', [TourController::class, 'getWeatherTest'])->name('/weather');

        // // Add path
        // var path = {!! json_encode($path) !!};
        // var shortestPath = L.polyline(path, {
        //     color: 'red'
        // }).addTo(map);
