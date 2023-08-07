<?php

namespace App\Http\Controllers;

use App\Models\webBrief;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class WebBriefController extends Controller
{
    //

    public function update(Request $request)
    {

        $brief = webBrief::find($request->brief_id);
        if ($request->has('image')) {
            storage::delete($brief->image);
            $filename = Storage::putFile('brief_img', $request->file('image'));
        }

        $brief->update([
            'user_id' => $request->user_id,
            'brief' => $request->brief,
            'image' => $filename
        ]);
        Session::flash('msg', 'brief updated successfuly');
        return redirect(url('home'));
    }


    public function store(Request $request)
    {

        // return $request;
        $filename = Storage::putFile('brief_img', $request->file('image'));
        webBrief::create([
            // 'user_id' => $request->user_id,
            'brief' => $request->brief,
            'image' => $filename
        ]);
        Session::flash('msg', 'brief created successfuly');
        return redirect(url('home'));
    }

    public function destroy(Request $request)
    {
        $brief = webBrief::find($request->brief_id);
        storage::delete($brief->image);
        $brief->delete();
        Session::flash('msg', 'brief deleted successfuly');
        return redirect(url('home'));
    }
}
