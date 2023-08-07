<?php

namespace App\Http\Controllers;

use App\Models\book;
use App\Models\tour;
use App\Models\User;
use App\Models\feedback;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class FeedbackController extends Controller
{


    public function store(Request $request)
    {
        // dd( $request);

        $validatedData = Validator::make($request->all(), [
            'user_id' => [
                'required',
                Rule::in([Auth::id()]), // Validate that owner_id matches the authenticated user's ID
            ],
            'tour_id' => 'required|exists:tours,id',
            'rating' => 'required|numeric',
            'comment' => 'required',
        ]);

        if ($validatedData->fails()) {
            return back()->withErrors($validatedData)->withInput();
        } else {


            // Check if the user is a Participant tour
            $allParticipant = book::where('tour_id', '=', $request->tour_id)->get();
            $flag = 0 ;
            for ($i = 0; $i < count($allParticipant); $i++) {
                if($allParticipant[$i]->user_id ==  $request->user_id){
                    $flag = 1 ;
                    break;
                }
            }

            if($flag==1){
                feedback::create([
                    'comment' => $request->comment,
                    'tour_id' => $request->tour_id,
                    'star' => $request->rating,
                    'user_id' => $request->user_id,
                ]);
                toast('feedback created successfuly!','success');
                return back();
            }else{
                Session::flash('msg', 'feedback not created successfuly Because you are not one of the participants in the tour');
                return back();
            }
        }
    }

    public function edit($feedback_id)
    {
        // $user = User::find($user_id);
        $feedback = feedback::find($feedback_id);
        return view('feedback.edit', compact('feedback'));
    }

    public function update(Request $request)
    {
        $feedback = feedback::find($request->feedback_id);
        $feedback->update([
            'comment' => $request->comment,
        ]);
        Session::flash('msg', 'feedback updated successfuly');
        return redirect(url("feedback/$feedback->user_id"));
    }

    public function destroy(Request $request)
    {
        // return $request;
        $feedback = feedback::find($request->feedback_id);
        $feedback->delete();
        Session::flash('msg', 'feedback deleted successfuly');
        return redirect(url("feedback/$request->user_id"));
    }
}
