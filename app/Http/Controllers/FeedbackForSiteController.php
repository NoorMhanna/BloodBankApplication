<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\FeedbackForSite;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class FeedbackForSiteController extends Controller
{
    //


    // public function index()
    // {
    //     // model User serach table in DB names Users ..
    //     $feedbacks = FeedbackForSite::all();
    //     // dd($feedbacks);
    //     return (view('feedback.feedbackSite', compact('feedbacks')));
    // }



    // public function create($user_id)
    // {
    //     // return view('feedback.create', compact('user_id'));
    // }

    public function store(Request $request)
    {

        $filename = Storage::putFile('feedBack', $request->file('image'));

        FeedbackForSite::create([
            'comment' => $request->comment,
            'user_id' => $request->user_id,
            'name'=>$request->name,
            'image'=>$filename ,
        ]);
        Session::flash('msg', 'feedback created successfuly');
        return redirect(url("main"));
    }

    public function edit($feedback_id)
    {
        // $user = User::find($user_id);
        $feedback = FeedbackForSite::find($feedback_id);
        // return view('feedback.edit', compact('feedback'));
    }

    public function update(Request $request)
    {
        $feedback = FeedbackForSite::find($request->feedback_id);
        $feedback->update([
            'comment' => $request->comment,
        ]);
        Session::flash('msg', 'feedback updated successfuly');
        return redirect(url("main"));
    }

    public function destroy(Request $request)
    {
        // return $request;
        $feedback = FeedbackForSite::find($request->feedback_id);
        $feedback->delete();
        Session::flash('msg', 'feedback deleted successfuly');
        return redirect(url("main"));
    }
}
