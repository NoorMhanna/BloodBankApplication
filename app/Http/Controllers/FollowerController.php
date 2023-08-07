<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\follower;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use function PHPUnit\Framework\returnSelf;

class FollowerController extends Controller
{


    public function add(Request $request)
    {

        follower::create([
            'user_id' => Auth::id(),
            'friends' => $request->friend_id,
        ]);


        if ($request->following == "true")
            Notification::create([
                'note' => response()->json([
                    'friend' => User::find(Auth::id()),
                ])->content(),
                'type' => "friend",
                'user_id' => $request->friend_id,
            ]);

        if ($request->following == "false")
            Notification::where("id", "=", $request->not_id)->delete();

        // Session::flash('msg', 'Add friends successfuly');
        toast('Add friends successfuly!', 'success');
        return  back();
    }

    public function remove(Request $request)
    {

        Notification::find($request->not_id)->delete();
        $user_id = Auth::id();
        $friend_id = $request->friend_id;
        follower::where('user_id', '=', $user_id)->where('friends', '=', $friend_id)->delete();
        // return $deletefriends;
        // Session::flash('msg', 'deleted friends successfuly');
        toast('deleted friends successfuly!', 'success');
        return back();
        // return redirect(url('users'));
    }
}
