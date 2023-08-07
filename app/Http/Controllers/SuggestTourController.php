<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\liker;
use App\Models\Addliker;
use App\Models\suggestTour;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SuggestTourController extends Controller
{


    public function storeSuggestTour(Request $request)
    {

        // validation :
        $validatedData = Validator::make($request->all(), [
            'destination' => 'required',
            'user_id' => [
                'required',
                Rule::in([Auth::id()]), // Validate that owner_id matches the authenticated user's ID
            ],
        ]);
        // dd($request);

        if ($validatedData->fails()) {
            // dd($validatedData);
            toast('some error when suggest','Warning Message');
            back();
        } else {

            suggestTour::create([
                'destination' => $request->destination,
                'user_id' => Auth::id(),
            ]);
            toast('tour suggested successfuly','success');
            return back()   ;
            // ->with('success', 'The tour has been suggested in the suggestion list successfully!');
        }
    }

    public function DropSuggestTour($id)
    {

        // as time remove and when it taken
        $tour = suggestTour::find($id);
        $date = $tour->created_at->addDays(7);

        $carbonDate = Carbon::parse($date);
        $currentDate = Carbon::today();
        // dd($carbonDate);

        if ($currentDate->greaterThan($carbonDate)) {
            suggestTour::find($id)->delete();
            // note for user_id ..
            Notification::create([
                'note' => response()->json([
                    'msg' => "The tour that I proposed earlier from $tour->city to $tour->destination dropped because the period of its proposal exceeded the limit of seven days"
                ])->content(),
                'type' => 'Drop_suggest',
                'user_id' => $tour->user_id,
            ]);
        }
    }

    public function addLiker(Request $request)
    {
        // dd($request->id);
        Addliker::create([
            'user_id' => $request->user_id,
            'suggest_id' => $request->suggest_id,
        ]);
        return back();
    }
}
