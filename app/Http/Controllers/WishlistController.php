<?php

namespace App\Http\Controllers;

use App\Models\tour;
use App\Models\User;
use App\Models\wishlist;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class WishlistController extends Controller
{
    //
    public function index($user_id){

        $user = User::find($user_id);
        $lists=$user->wishList ;

        $tours=[];

        // return $lists;

        for($i=0;$i< count($lists) ;$i++){
            $id_Tour=($lists[$i]->tour_id);
            $tours[$i]=tour::find($id_Tour);
        }

        // return $tours;

        return view('wishlist.index', compact('tours','user'));
    }

    public function add($id){

        // dd(count($User));
        if (count(wishlist::where('user_id', '=', Auth::id())->where('tour_id', '=', $id)->get()) > 0){
            //willadded
            return back();
        }else {

            //validate ..
            $validator = Validator::make(
                ['id' =>$id,],
                ['id' => 'required|exists:tours,id']
            );

            if ($validator->fails()) {
                back();
            }else{
                wishlist::create([
                    'user_id' => Auth::id(),
                    'tour_id' => $id,
                ]);
                Session::flash('msg', 'tours added successfuly');
                return back();
            }
        }
    }

    public function destroy($id){

        if (count(wishlist::where('user_id', '=', Auth::id())->where('tour_id', '=', $id)->get()) > 0){
            wishlist::where('user_id', '=', Auth::id())->where('tour_id', '=', $id)->delete();
            Session::flash('msg','tour deleted from WishList successfuly');
            return   back();
        }else{
            return   back();
        }
    }
}
