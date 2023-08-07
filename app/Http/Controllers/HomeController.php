<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\book;
use App\Models\tour;
use App\Models\User;
use App\Models\Addliker;
use App\Models\follower;
use App\Models\webBrief;
use App\Models\wishlist;
use App\Models\suggestTour;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */



    public function home()
    {
        $user = User::find(Auth::id());
        $allUser = User::all();
        $allTourOwner = User::where('type', '=', 'tour_owner')->get();
        $allTours = tour::all();

        $availableTours = tour::where('available', '=', '1')->get();
        $OwnerForAvailable = $this->getOwnerForTour($availableTours);
        $numberOfBookingInForAvailable = $this->getNumberOfBookingForTour($availableTours);

        $previousTours = tour::where('available', '=', '0')->get();
        $OwnerForpreviousTours = $this->getOwnerForTour($previousTours);
        $numberOfBookingInForpreviousTours = $this->getNumberOfBookingForTour($previousTours);

        $brief = webBrief::find(1);
        // $routeNameForDetails  = "login";
        // $routeName = "login";

        $listWishListTour = $this->wishListForUser();
        //
        $AlltoursSuggest = $this->ListSuggestTour() ;
        $OwnerForSuggest = $this->getOwnerForTour($AlltoursSuggest);
        $numberForLikers = $this->getnumberOfLikers($AlltoursSuggest);

        $frinds  = $this->getFriendForUser();
        $notefication = Notification::where('user_id', '=', Auth::id())->get();
        $myRegistredTour =  $this->myRegistredTour();

        // dd($myRegistredTour);


        return (view('home', compact(
            // 'feedbacks',
            // 'users',
            'allUser',
            'allTourOwner',
            'previousTours',
            'availableTours',
            'OwnerForpreviousTours',
            'OwnerForAvailable',
            'numberOfBookingInForAvailable',
            'numberOfBookingInForpreviousTours',
            'brief',
            'user',
            'allTours',
            'listWishListTour',
            // 'path',
            'AlltoursSuggest',
            'OwnerForSuggest',
            'numberForLikers',
            'frinds',
            'notefication',
            'myRegistredTour'
        )));
    }


    // --------------------------------------Suggest Tours -----------------------------------

    public function ListSuggestTour()
    {
        $this->DropSuggestTour();
        return suggestTour::all();
    }

    public function storeSuggestTour(Request $request)
    {

        // validation :
        $validatedData = Validator::make($request->all(), [
            'city' => 'required',
            'destination' => 'required',
            'user_id' => [
                'required',
                Rule::in([Auth::id()]), // Validate that owner_id matches the authenticated user's ID
            ],
        ]);
        // dd($request);

        if ($validatedData->fails()) {
            back();
        } else {

            suggestTour::create([
                'city' => $request->city,
                'destination' => $request->destination,
                'user_id' => Auth::id(),
            ]);
            Session::flash('msg', 'tour created successfuly');
            return redirect()->route('/home')->with('success', 'The tour has been suggested in the suggestion list successfully!');
        }
    }

    public function DropSuggestTour()
    {

        $allsuggest = suggestTour::all();
        for ($i = 0; $i < count($allsuggest); $i++) {
            // as time remove and when it taken
            $tour = suggestTour::find($allsuggest[$i]->id);
            $date = $tour->created_at->addDays(7);

            $carbonDate = Carbon::parse($date);
            $currentDate = Carbon::today();
            // dd($carbonDate);

            if ($currentDate->greaterThan($carbonDate)) {
                suggestTour::find($allsuggest[$i]->id)->delete();
                // note for user_id ..
                Notification::create([
                    'note' => response()->json([
                        'msg' => "The tour that you proposed earlier from $tour->city to $tour->destination dropped because the period of its proposal exceeded the limit of seven days"
                    ])->content(),
                    'type' => 'Drop_suggest',
                    'user_id' => $tour->user_id,
                ]);
            }
        }
    }


    // -------------------------------------- Tours -----------------------------------


    public function myRegistredTour()
    {
        $myRegistredTour = book::where('user_id', '=', Auth::id())->get();
        $register = [];
        $index = 0;
        for ($i = 0; $i < count($myRegistredTour); $i++) {

            $tour = tour::find($myRegistredTour[$i]->tour_id);
            // dd($tour);
            $tourDateCarbon = Carbon::parse($tour->dateOFTour);
            $currentDate = Carbon::now();
            if ($tourDateCarbon >= $currentDate) {
                $register[$index] = $tour;
                $index++;
            }
        }
        return $register;
    }

    public function getOwnerForTour($Tours)
    {
        $Owner  = [];
        for ($i = 0; $i < count($Tours); $i++) {
            $Owner[$i] = User::find($Tours[$i]->user_id);
        }
        return $Owner;
    }

    public function getNumberOfBookingForTour($availableTours)
    {

        $numberOfBooking = [];
        for ($i = 0; $i < count($availableTours); $i++) {
            $booking = book::where('tour_id', '=', $availableTours[$i]->id)->get();
            $numberOfBooking[$i] = count($booking);
        }

        return $numberOfBooking;
    }


    // -------------------------------------- WishList -----------------------------------
    public function wishListForUser()
    {
        // dd(Auth::id());
        $list = wishlist::where('user_id', '=', Auth::id())->get();

        // dd(count($list));
        $wishlist = [];

        for ($i = 0; $i < count($list); $i++) {
            $wishlist[$i] = tour::find($list[$i]->tour_id);
        }

        // dd($wishlist);

        // dd($wishlist);
        return $wishlist;
    }


    public function getnumberOfLikers($AlltoursSuggest)
    {
        $number = [];
        // dd($AlltoursSuggest);
        for ($i = 0; $i < count($AlltoursSuggest); $i++) {

            $tours = Addliker::where('suggest_id', '=', $AlltoursSuggest[$i]->id)->get();

            if ($tours != null) {
                $number[$i] = count($tours);
            } else
                $number[$i] = 0;
        }
        // dd($number);
        return $number;
    }


    // -------------------------------------- Friends: -----------------------------------
    public function getFriendForUser()
    {
        $id =  Auth::id();
        $Folowing = follower::where('user_id', '=', Auth::id())->get();

        $f = [];
        for ($i = 0; $i < count($Folowing); $i++)
            $f[$i] = $Folowing[$i]->friends;
        // dd($f);

        $randomData = DB::table('Users')
            ->inRandomOrder()
            ->where('id', '!=', $id)
            ->whereNotIn('id', $f)
            ->take(15)
            ->get();

        // dd($randomData);
        //expect his friends .........................................

        return $randomData;
    }

    // -------------------------------------- Admin: -----------------------------------
    public function curdUsers()
    {

        $listWishListTour = $this->wishListForUser();
        $user = User::find(Auth::id());
        $allusers = User::where('type', '!=', 'admin')->get();
        $brief = webBrief::find(1);
        $notefication = Notification::where('user_id', '=', Auth::id())->get();
        $myRegistredTour =  $this->myRegistredTour();


        return view('users.curdUsers', compact(
            'listWishListTour',
            'user',
            'allusers',
            'brief',
            'notefication',
            'myRegistredTour'
        ));
    }

    public function curdUsersToEditUser($id)
    {

        $listWishListTour = $this->wishListForUser();
        $allusers = User::where('type', '!=', 'admin')->get();
        $brief = webBrief::find(1);
        $user = User::find($id);
        $notefication = Notification::where('user_id', '=', Auth::id())->get();
        $myRegistredTour =  $this->myRegistredTour();




        return view('users.editAdmin_ForUser', compact(
            'listWishListTour',
            'user',
            'allusers',
            'brief',
            'notefication',
            'myRegistredTour'
        ));
    }




    public function filterToursAsPrice(Request $request)
    {
        // dd( $request->input('price'));
        // print_r($request()->all());
        $budget = $request->input('price');
        $availableTours = Tour::where('price', '<', $budget) -> where('available', '=', '1')
            ->orderBy('price', 'asc')
            ->get();



            $user = User::find(Auth::id());
            $allUser = User::all();
            $allTourOwner = User::where('type', '=', 'tour_owner')->get();
            $allTours = tour::all();

            // $availableTours = tour::where('available', '=', '1')->get();
            $OwnerForAvailable = $this->getOwnerForTour($availableTours);
            $numberOfBookingInForAvailable = $this->getNumberOfBookingForTour($availableTours);

            $previousTours = tour::where('available', '=', '0')->get();
            $OwnerForpreviousTours = $this->getOwnerForTour($previousTours);
            $numberOfBookingInForpreviousTours = $this->getNumberOfBookingForTour($previousTours);

            $brief = webBrief::find(1);
            // $routeNameForDetails  = "login";
            // $routeName = "login";

            $listWishListTour = $this->wishListForUser();
            //
            $AlltoursSuggest = $this->ListSuggestTour() ;
            $OwnerForSuggest = $this->getOwnerForTour($AlltoursSuggest);
            $numberForLikers = $this->getnumberOfLikers($AlltoursSuggest);

            $frinds  = $this->getFriendForUser();
            $notefication = Notification::where('user_id', '=', Auth::id())->get();
            $myRegistredTour =  $this->myRegistredTour();

            // dd($myRegistredTour);


            return (view('home', compact(
                // 'feedbacks',
                // 'users',
                'allUser',
                'allTourOwner',
                'previousTours',
                'availableTours',
                'OwnerForpreviousTours',
                'OwnerForAvailable',
                'numberOfBookingInForAvailable',
                'numberOfBookingInForpreviousTours',
                'brief',
                'user',
                'allTours',
                'listWishListTour',
                // 'path',
                'AlltoursSuggest',
                'OwnerForSuggest',
                'numberForLikers',
                'frinds',
                'notefication',
                'myRegistredTour'
            )));

    }

    public function filterToursAsCity(Request $request)
    {
        // dd($request);
        // print_r($request->all());
        $x = $request->input('city');
        $availableTours = Tour::where('destination', '=', $x)->get();




            $user = User::find(Auth::id());
            $allUser = User::all();
            $allTourOwner = User::where('type', '=', 'tour_owner')->get();
            $allTours = tour::all();

            // $availableTours = tour::where('available', '=', '1')->get();
            $OwnerForAvailable = $this->getOwnerForTour($availableTours);
            $numberOfBookingInForAvailable = $this->getNumberOfBookingForTour($availableTours);

            $previousTours = tour::where('available', '=', '0')->get();
            $OwnerForpreviousTours = $this->getOwnerForTour($previousTours);
            $numberOfBookingInForpreviousTours = $this->getNumberOfBookingForTour($previousTours);

            $brief = webBrief::find(1);
            // $routeNameForDetails  = "login";
            // $routeName = "login";

            $listWishListTour = $this->wishListForUser();
            //
            $AlltoursSuggest = $this->ListSuggestTour() ;
            $OwnerForSuggest = $this->getOwnerForTour($AlltoursSuggest);
            $numberForLikers = $this->getnumberOfLikers($AlltoursSuggest);

            $frinds  = $this->getFriendForUser();
            $notefication = Notification::where('user_id', '=', Auth::id())->get();
            $myRegistredTour =  $this->myRegistredTour();

            // dd($myRegistredTour);


            return (view('home', compact(
                // 'feedbacks',
                // 'users',
                'allUser',
                'allTourOwner',
                'previousTours',
                'availableTours',
                'OwnerForpreviousTours',
                'OwnerForAvailable',
                'numberOfBookingInForAvailable',
                'numberOfBookingInForpreviousTours',
                'brief',
                'user',
                'allTours',
                'listWishListTour',
                // 'path',
                'AlltoursSuggest',
                'OwnerForSuggest',
                'numberForLikers',
                'frinds',
                'notefication',
                'myRegistredTour'
            )));


        // return response()->json($filteredTours);
    }
}
