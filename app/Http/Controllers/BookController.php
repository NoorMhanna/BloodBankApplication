<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\book;
use App\Models\tour;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{

    public function add(Request $request)
    {
        if (count(book::where('user_id', '=', Auth::id())->where('tour_id', '=', $request->tour_id)->get()) > 0) {
            return back();
        } else {
            //validate ..
            $validatedData = Validator::make($request->all(), [
                'tour_id' => 'required|exists:tours,id',
            ]);
            // dd($request);

            if ($validatedData->fails()) {
                back();
            } else {

                $myBookTour = book::where("user_id", '=', Auth::id())->get();
                $if×verlap = 0;

                for ($i = 0; $i < count($myBookTour); $i++) {
                    $tourPast = tour::find($myBookTour[$i]->tour_id);
                    $tourNow = tour::find($request->tour_id);

                    $dateBast = Carbon::parse($tourPast->dateOFTour);
                    $dateNow = Carbon::parse($tourNow->dateOFTour);

                    if ($dateBast->eq($dateNow) &&  $tourPast->available == 1) {
                        $if×verlap = 1;
                        break;
                    }
                }

                if ($if×verlap == 1) {
                    Session::flash('msg', 'nobooking successfuly');
                    return back();
                } else {
                    book::create([
                        'user_id' => Auth::id(),
                        'tour_id' => $request->tour_id,
                    ]);
                    Session::flash('msg', "Note that you are registered in the another tour on the same day as this tour , Check your list of registered tours");
                    return back();
                }
            }
        }
    }

    public function remove(Request $request)
    {
        if (count(book::where('user_id', '=', Auth::id())->where('tour_id', '=', $request->tour_id)->get()) == 0) {
            // dd($request);
            return back();
        } else {
            $validatedData = Validator::make($request->all(), [
                'tour_id' => 'required|exists:tours,id',
            ]);

            if ($validatedData->fails()) {
                // dd($request);
                back();
            } else {

                $tour = tour::find($request->tour_id);
                $tourDateCarbon = Carbon::parse($tour->dateOFTour);
                $currentDate = Carbon::now();

                // Subtract 2 days from the current date
                $twoDaysAgo = $tourDateCarbon->subDays(2);

                if ($currentDate  >= $twoDaysAgo) {
                    Session::flash('msg', 'can`t delete your booking');
                    return back();
                } else {
                    // dd($tour->dateOFTour);
                    book::where('user_id', '=', Auth::id())->where('tour_id', '=', $request->tour_id)->delete();
                    Session::flash('msg', 'delete booking successfuly');
                    return back();
                }
            }
        }
    }


    public function removeByAdmin(Request $request)
    {

        $validatedData = Validator::make($request->all(), [
            'tour_id' => 'required|exists:tours,id',
            'user_id' => 'required|exists:users,id',
            'owner_id' => [
                'required',
                Rule::in([Auth::id()]), // Validate that owner_id matches the authenticated user's ID
            ],
        ]);

        if ($validatedData->fails()) {
            // dd($request);
            return back();
        } else {
            if (count(book::where('user_id', '=', $request->user_id)->where('tour_id', '=', $request->tour_id)->get()) == 0) {
                return back();
            } else {
                // dd($request);
                book::where('user_id', '=', $request->user_id)->where('tour_id', '=', $request->tour_id)->delete();

                //Notification
                $tour = tour::find($request->tour_id);
                Notification::create([
                    'note' => response()->json([
                        'msg' => 'note ! You have been removed from the ' . $tour->name . ' tour by the admin'
                    ])->content(),
                    'type' => 'Drop_regester',
                    'user_id' => $request->user_id,
                ]);
                Session::flash('msg', 'delete booking successfuly');
                return back();
            }
        }
    }
}
