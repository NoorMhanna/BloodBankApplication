<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\book;
use App\Models\tour;
use App\Models\User;
use GuzzleHttp\Client;
use App\Models\Activity;
use App\Models\feedback;
use App\Models\webBrief;
use App\Models\wishlist;
use App\Models\suggestTour;
use App\Models\Notification;
use Illuminate\Http\Request;
use Dflydev\DotAccessData\Data;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TourController extends Controller
{

    public function store(Request $request)
    {
        // convert avaliable from 1 to 0 ..

        $validatedData = Validator::make($request->all(), [
            'name' => 'required',
            'source' => 'required',
            'destination' => 'required',
            'description' => 'required',
            'dateOFTour' => 'required',
            'max_participate' => 'required|numeric',
            'price' => 'required|numeric',
            'max_participate' => 'required|numeric',
            'short_description' => 'required',
            'activity' => 'required',
            'time' => 'required',
            'path' => 'required',
            'image' => 'required',
        ]);

        if ($validatedData->fails()) {
            return redirect(url('/CurdWithPopCreate'))->withErrors($validatedData)->withInput();
        } else {
            //short_description
            $short_description = json_encode($request->input('short_description'));
            //Activity
            $ActivityAndTime = array_merge($request->activity, $request->time);
            $ActivityAndTime_json = json_encode($ActivityAndTime);
            //images :
            $images = [];
            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $image) {
                    $filename = Storage::putFile('tour_img', $image);
                    $images[] = $filename;
                }
            }
            $image_json = json_encode($images);
            // dd($short_description);

            //path
            $City_json = $this->spiltPath($request->path);
            $finalPathForTour = json_encode($this->finalPathForTour($City_json));
            // dd($finalPathForTour);

            $cordinateCity = json_decode($this->getCoordinates($request->destination)->content());
            // dd($cordinateCity->latitude);

            tour::create([
                'user_id' => Auth::id(),
                'name' => $request->name,
                'source' => $request->source,
                'destination' => $request->destination,
                'latitude' => $cordinateCity->latitude,
                'longitude' => $cordinateCity->longitude,
                'description' => $request->description,
                'dateOFTour' => $request->dateOFTour,
                'max_participate' => $request->max_participate,
                'price' => $request->price,
                'max_participate' => $request->max_participate,
                'short_description' => $short_description,
                'ActivityAndTime' => $ActivityAndTime_json,
                'images' => $image_json,
                'path' => $finalPathForTour,
            ]);

            // dd($request->has("idSuggerster"));
            // if tours created by suggest :
            if($request->has("idSuggerster")){
                $owner = User::find(Auth::id());
                $response_not = response()->json([
                    'msg' => "The $request->name tour you suggested was taken by $owner->name",
                ]);
                Notification::create([
                    'note'=> $response_not->content(),
                    'type' => 'suggest' ,
                    'user_id'=> $request->idSuggerster,
                ]);

            //delete suggest Tour that token :
            suggestTour::where("destination", "=",$request->destination)->where("user_id", "=",$request->idSuggerster)->delete();
            }

            $this->checkAvailableAndConvert();
            Session::flash('msg', 'tour created successfuly');
            return redirect(url('tours/' . tour::max('id')));
        }

    }


    public function spiltPath($stringPath)
    {
        $path_spit = explode('-', $stringPath);

        foreach ($path_spit as $value) {
            if ($value != "")
                $city[] = trim($value);
        }
        $jsonData = json_encode($city);
        return $jsonData;
    }

    public function update(Request $request)
    {

        // convert avaliable from 1 to 0 ..

        $tourId = $request->tour_id;
        $validatedData = Validator::make($request->all(), [
            'user_id' => [
                'required',
                'numeric',
                Rule::exists('tours', 'user_id')->where(function ($query) use ($tourId) {
                    $query->where('id', $tourId);
                }),
                Rule::in([Auth::id()]),
            ],
            'tour_id' => 'required|numeric|exists:tours,id',
            'name' => 'required',
            'source' => 'required',
            'destination' => 'required',
            'description' => 'required',
            'dateOFTour' => 'required',
            'max_participate' => 'required|numeric',
            'price' => 'required|numeric',
            'max_participate' => 'required|numeric',
            'short_description' => 'required',
            'activity' => 'required',
            'time' => 'required',
            'path' => 'required',
            'image' => 'required',
        ]);

        if ($validatedData->fails()) {
            return redirect(url("CurdWithPopUpdate/$tourId"))->withErrors($validatedData)->withInput();
        } else {

            // dd($request);

            $tour = tour::find($request->tour_id);

            //short_description
            $short_description = json_encode($request->input('short_description'));
            //Activity
            $ActivityAndTime = array_merge($request->activity, $request->time);
            $ActivityAndTime_json = json_encode($ActivityAndTime);
            //images :
            $images = [];
            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $image) {
                    $filename = Storage::putFile('tour_img', $image);
                    $images[] = $filename;
                }
            }
            $image_json = json_encode($images);
            // dd($short_description);

            //path
            $City_json = $this->spiltPath($request->path);
            $finalPathForTour = json_encode($this->finalPathForTour($City_json));
            // dd($finalPathForTour);


            // if($request->has('image')){
            //     Storage::delete($tour->image);// delete previos img
            //     $filename=Storage::putFile('tours_img',$request->file('image'));
            // }

            $tour->update([
                'user_id' => $request->user_id,
                'name' => $request->name,
                'source' => $request->source,
                'destination' => $request->destination,
                'description' => $request->description,
                'dateOFTour' => $request->dateOFTour,
                'max_participate' => $request->max_participate,
                'tour_owner_id' => $request->user_id,
                'price' => $request->price,
                'max_participate' => $request->max_participate,
                'short_description' => $short_description,
                'ActivityAndTime' => $ActivityAndTime_json,
                'images' => $image_json,
                'path' => $finalPathForTour,
            ]);

            // dd($tour);

            $this->checkAvailableAndConvert();
            toast('tour updated successfuly!', 'success');
            return redirect(url('tours/' . $tour->id));
        }
    }


    public function delete(Request $request)
    {
        // convert avaliable from 1 to 0 ..

        $tourId = $request->tour_id;
        $validatedData = Validator::make($request->all(), [
            'user_id' => [
                'required',
                'numeric',
                Rule::exists('tours', 'user_id')->where(function ($query) use ($tourId) {
                    $query->where('id', $tourId);
                }),
                Rule::in([Auth::id()]),
            ],
            'tour_id' => 'required|numeric|exists:tours,id',
        ]);

        if ($validatedData->fails()) {
            return redirect(url('/curdTours'))->withErrors($validatedData)->withInput();
        } else {

            $tour = tour::find($request->tour_id);
            $images = json_decode($tour->images);

            for ($i = 0; $i < count($images); $i++)
                storage::delete($images[$i]);
            $tour->delete();
            // Session::flash('msg', 'tour deleted successfuly');
            toast('tour deleted successfuly!', 'success');
            return  redirect(url('/curdTours'));
        }
    }

    // Details :
    public function ShowDetailsForTour($id)
    {

        // convert avaliable from 1 to 0 ..

        $listWishListTour = $this->wishListForUser();
        $user = user::find(Auth::id());
        $tour = tour::find($id);
        $d_Tour = $tour->source;
        $owner = user::find($tour->user_id);

        $showParticipant = $this->showParticipant($tour->id);
        $status =  $this->ifExist($tour->id);
        $ifFavorite = $this->ifFavorite($tour->id);
        //feedBack:
        $feedBackForTour = $this->MyFeedBackForTour($id);
        $users_feedBack = $this->howAddFeedback($feedBackForTour);

        $brief = webBrief::find(1);
        // dd($users_feedBack);

        $RecommandationTour = $this->RecommandationTour($tour);
        $OwnerForRecommandationTour = $this->getOwnerForTour($RecommandationTour);
        $numberOfBookingInRecommandationTour = $this->getNumberOfBookingForTour($RecommandationTour);
        $notefication = Notification::where('user_id', '=', Auth::id())->get();
        $myRegistredTour =  $this->myRegistredTour();


        //
        $weather = $this->getWeather($d_Tour);
        // dd($weather);

        // dd($ifFavorite);

        return view('tours.DetailsTour.detailsTour', compact(
            'tour',
            'listWishListTour',
            'user',
            'owner',
            'showParticipant',
            'status',
            'feedBackForTour',
            'users_feedBack',
            'brief',
            'RecommandationTour',
            'OwnerForRecommandationTour',
            'numberOfBookingInRecommandationTour',
            'notefication',
            'ifFavorite',
            'myRegistredTour',
            'weather'
        ));
    }


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

    public function RecommandationTour($tour)
    {
        $description = json_decode($tour->short_description);
        $allTour = tour::where('available', '=', '1')->where('id', '!=', $tour->id)->get();

        $RecommandationTourArray = [];
        $counter = 0;

        for ($i = 0; $i < count($allTour); $i++) {
            $d = json_decode($allTour[$i]->short_description);
            $foundValues = array_intersect($d, $description);
            if (count($foundValues) >= 3 && $allTour[$i]->available == 1) {
                $RecommandationTourArray[$counter] = $allTour[$i];
                $counter++;
            }
        }
        // dd($RecommandationTourArray);
        return $RecommandationTourArray;
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


    //wishList :
    public function wishListForUser()
    {
        // dd(Auth::id());
        $list = wishlist::where('user_id', '=', Auth::id())->get();
        $wishlist = [];
        for ($i = 0; $i < count($list); $i++) {
            $wishlist[$i] = tour::find($list[$i]->tour_id);
        }
        return $wishlist;
    }




    //Booking:
    public function showParticipant($tour_id)
    {
        $allParticipant = book::where('tour_id', '=', $tour_id)->get();
        $Participant = [];

        for ($i = 0; $i < count($allParticipant); $i++) {
            $Participant[$i] = User::find($allParticipant[$i]->user_id);
        }
        return ($Participant);
    }

    public function ifExist($tour_id)
    {
        $User = book::where('user_id', '=', Auth::id())->where('tour_id', '=', $tour_id)->get();
        // dd(count($User));

        if (count($User) > 0)
            return 1;
        else
            return 0;
    }

    public function ifFavorite($tour_id)
    {
        $User = wishlist::where('user_id', '=', Auth::id())->where('tour_id', '=', $tour_id)->get();
        // dd(count($User));

        if (count($User) > 0)
            return 1;
        else
            return 0;
    }


    //Path :
    public function getCoordinates($city)
    {
        $client = new Client();
        $response = $client->get('https://nominatim.openstreetmap.org/search', [
            'query' => [
                'q' => $city,
                'format' => 'json',
                'limit' => 1,
            ],
        ]);

        $data = json_decode($response->getBody(), true);

        // dd($data );

        if (!empty($data)) {
            $latitude = $data[0]['lat'];
            $longitude = $data[0]['lon'];

            // dd($data);

            // dd($latitude);
            return response()->json([
                'place' => $city,
                'latitude' => $latitude,
                'longitude' => $longitude,
            ]);
        }

        return response()->json(['error' => "Geocoding failed for $city"], 500);
    }

    public function finalPathForTour($arrayOfCity)
    {

        $city = json_decode($arrayOfCity);
        // dd($city[0]);
        $cordinateAllCity = [];
        for ($i = 0; $i < count($city); $i++) {
            $cordinateAllCity[$i] = json_decode($this->getCoordinates($city[$i])->content());
        }
        // dd($cordinateAllCity);
        return $cordinateAllCity;
    }


    //weather :
    public function getWeather($city)
    {

        $apiKey = '022af4c03de813dad4dc89a061c9bea6';
        $baseUrl = 'http://api.openweathermap.org/data/2.5/forecast';


        // $city = $request->input('city', 'Ramallah'); // Default city is London

        $response = Http::get($baseUrl, [
            'q' => $city,
            'appid' => $apiKey,
            'units' => 'metric', // Use 'imperial' for Fahrenheit
        ]);

        if ($response->failed()) {
            abort(500, 'Failed to fetch weather data.');
        }

        $weatherData = $response->json();
        $forecast = collect($weatherData['list']);

        // Group forecast data by date (ignoring the time part)
        $groupedForecast = $forecast->groupBy(function ($item) {
            return date('Y-m-d', strtotime($item['dt_txt']));
        });

        // Take the first forecast for each day
        $uniqueForecast = $groupedForecast->map(function ($items) {
            return $items->first();
        });

        return $uniqueForecast ;
    }


    //feedback:
    public function MyFeedBackForTour($id)
    {
        $feedBackForTour  = feedback::where('tour_id', '=', $id)->get();
        return  $feedBackForTour;
    }

    public function howAddFeedback($feedBack)
    {
        //

        if (count($feedBack) == 0) {
            $users_feedback = [];
        }

        for ($i = 0; $i < count($feedBack); $i++) {
            $users_feedback[]  = user::find($feedBack[$i]->user_id);
        }
        // dd($users_feedback);
        return $users_feedback;
    }


    // ----------------------------- CURD ---------------------------
    public function curdTour()
    {
        $listWishListTour = $this->wishListForUser();
        $user = user::find(Auth::id());
        $myTours = tour::where('user_id', '=', Auth::id())->get();
        // $Owner_take_tour="";
        // $userWhoSuggest="";
        $notefication = Notification::where('user_id', '=', Auth::id())->get();
        $myRegistredTour =  $this->myRegistredTour();
        $ifSuggest=false;

        return view('tours.curdTour', compact(
            'user',
            'listWishListTour',
            'myTours',
            // 'Owner_take_tour',
            // 'userWhoSuggest',
            'notefication',
            'myRegistredTour',
            'ifSuggest'
        ));
    }

    public function curdTourWithPopCreate()
    {

        $listWishListTour = $this->wishListForUser();
        $user = user::find(Auth::id());
        $myTours = tour::where('user_id', '=', Auth::id())->get();
        $notefication = Notification::where('user_id', '=', Auth::id())->get();
        $myRegistredTour =  $this->myRegistredTour();
        $ifSuggest = false ;

        return view('tours.CurdWithPopCreate', compact(
            'user',
            'listWishListTour',
            'myTours',
            'notefication',
            'myRegistredTour',
            'ifSuggest'
        ));
    }

    public function curdTourWithPopCreateSuggest($destination , $idSuggerster)
    {

        $listWishListTour = $this->wishListForUser();
        $user = user::find(Auth::id());
        $myTours = tour::where('user_id', '=', Auth::id())->get();
        $notefication = Notification::where('user_id', '=', Auth::id())->get();
        $myRegistredTour =  $this->myRegistredTour();
        $ifSuggest = true ;


        return view('tours.CurdWithPopCreate', compact(
            'user',
            'listWishListTour',
            'myTours',
            'notefication',
            'myRegistredTour',
            'ifSuggest',
            'destination',
            'idSuggerster',
        ));
    }

    public function curdTourWithPopUpdate($id)
    {
        $listWishListTour = $this->wishListForUser();
        $user = user::find(Auth::id());
        $myTours = tour::where('user_id', '=', Auth::id())->get();
        $notefication = Notification::where('user_id', '=', Auth::id())->get();
        $myRegistredTour =  $this->myRegistredTour();
        $tour = tour::find($id);

        return view('tours.CurdWithPopUpdate', compact(
            'user',
            'listWishListTour',
            'myTours',
            'notefication',
            'myRegistredTour',
            'tour'
        ));
    }



    // ----------------------------- Available ---------------------------

    public function checkAvailableAndConvert()
    {

        $allTours = tour::where('available', '=', '1')->get();
        // dd($allTours[0]->dateOFTour);
        for ($i = 0; $i < count($allTours); $i++) {
            $carbonDate = Carbon::parse($allTours[$i]->dateOFTour);
            $currentDate = Carbon::today();
            // dd($currentDate->greaterThan($carbonDate));
            if ($currentDate->greaterThan($carbonDate)) {
                $allTours[$i]->update([
                    'available' => 0,
                ]);
                // dd($allTours[$i]);
            }
        }
    }

    // ----------------------------- search ---------------------------

    // public function searchByPrice($id_price)
    // {
    //     $tours = tour::where('price', '<=', $id_price)->get();
    //     return view('tours.search.search', compact('tours'));
    // }

    // public function searchByCity($id_city)
    // {
    //     $tours = tour::where('source', '=', $id_city)->get();
    //     return view('tours.search.search', compact('tours'));
    // }

    // public function searchByDate($date)
    // {
    //     $tours = tour::where('dateOFTour', '<=', $date)->get();
    //     // return $tours;
    //     return view('tours.search.search', compact('tours'));
    // }

    // public function searchByCompany($name_owner)
    // {

    //     $users = User::where('type', '=', 'tour_owner')->where('name', '=', $name_owner)->get();
    //     return view('tours.search.myCompany', compact('users'));
    // }
}
