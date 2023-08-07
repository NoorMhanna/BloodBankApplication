<?php

namespace App\Http\Controllers;

// use Alert ;
use Carbon\Carbon;
use App\Models\book;
use App\Models\Post;
use App\Models\tour;
use App\Models\User;
use GuzzleHttp\Client;
use App\Models\feedback;
use App\Models\follower;
use App\Models\webBrief;
use App\Models\wishlist;
use App\Models\Notification;
// use App\Models\FeedbackForSite;
use Illuminate\Http\Request;
use App\Models\LikersForPost;
use Illuminate\Validation\Rule;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\createUserRequest;
// use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\deleteUserRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Console\View\Components\Alert;
// Use Illuminate\Console\View\Components\Alert


class UserController extends Controller
{


    // -----------------------------------Login + Sign Up -----------------------------------------

    public function signUpForm()
    {
        // $feedbacks = FeedbackForSite::all();
        // $users = $this->getUser_feedbackForSite($feebacks);
        // dd($users);d
        // dd($feedbacks);

        $allUser = User::all();
        $allTourOwner =  User::where('type', '=', 'tour_owner')->get();

        $availableTours = tour::where('available', '=', '1')->get();
        $OwnerForAvailable = $this->getOwnerForTour($availableTours);
        $numberOfBookingInForAvailable = $this->getNumberOfBookingForTour($availableTours);

        $previousTours = tour::where('available', '=', '0')->get();
        $OwnerForpreviousTours = $this->getOwnerForTour($previousTours);
        $numberOfBookingInForpreviousTours = $this->getNumberOfBookingForTour($previousTours);

        $brief = webBrief::find(1);

        return (view('auth.pop.popSignUp', compact(
            'allUser',
            'allTourOwner',
            'previousTours',
            'availableTours',
            'OwnerForpreviousTours',
            'OwnerForAvailable',
            'numberOfBookingInForAvailable',
            'numberOfBookingInForpreviousTours',
            'brief'
        )));
    }

    public function signUp(Request $request)
    {

        $validatedData = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|unique:users,email',
            'phone_number' => 'required|min:7',
            'password' => 'required|min:5',
            'setting' => 'required'
        ]);

        if ($validatedData->fails()) {
            return redirect(url('/signUp'))->withErrors($validatedData)->withInput();
        } else {

            if ($request->has('image')) {

                $validate = $request->validate([
                    'image' => 'required|image|mimes:png,jpg,JPEG',
                ]);
                if ($validate) {
                    $filename = "";
                    $filename = Storage::putFile('user_img', $request->file('image'));
                } else {
                    return redirect(url('/signUp'))->withErrors($validatedData)->withInput();
                }
            } else {
                $filename = "user_img/avatar.png";
            }

            $name = $request->name ;
            // dd($name);

            $user = User::create([
                'name' =>  $name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'password' => Hash::make($request->password),
                'image' => $filename,
                'setting' => $request->setting,
            ]);
            // dd($user);
            Alert::success('Welcome to the YallaRehla website', 'Your Acount Created Successfuly');
            Auth::login($user);
            return redirect(url('home'));
        }
    }

    public function loginForm()
    {

        // $feedbacks = FeedbackForSite::all();
        // $users = $this->getUser_feedbackForSite($feedbacks);
        // dd($users);
        // dd($feedbacks);

        $allUser = User::all();
        $allTourOwner = User::where('type', '=', 'tour_owner')->get();

        $availableTours = tour::where('available', '=', '1')->get();
        $OwnerForAvailable = $this->getOwnerForTour($availableTours);
        $numberOfBookingInForAvailable = $this->getNumberOfBookingForTour($availableTours);

        $previousTours = tour::where('available', '=', '0')->get();
        $OwnerForpreviousTours = $this->getOwnerForTour($previousTours);
        $numberOfBookingInForpreviousTours = $this->getNumberOfBookingForTour($previousTours);

        $brief = webBrief::find(1);

        return (view('auth.pop.popLogin', compact(
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
        )));


        // return view ('auth.pop.popLogin');
    }

    public function login(Request $request)
    {
        $validator = Validator::make(
            [
                'email' => $request->email,
                'password' => $request->password
            ],

            [
                'email' => 'required|exists:users,email',
                'password' => 'required',
            ]
        );

        if ($validator->fails()) {

            return redirect(url('/login'))->withErrors($validator)->withInput();
        } else {
            $isLogin = Auth::attempt(['email' => $request['email'], "password" => $request['password']]);
            if ($isLogin != true) {
                // return redirect(url('/login'))->withErrors($data)->withInput();
                return redirect(url('/login'))->withErrors('Credinations not correct');
            } else {
                return redirect(url('home'));
            }
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect(url('/main'));
    }

    // -----------------------------------Main-----------------------------------------

    public function main()
    {

        // $feedbacks = FeedbackForSite::all();
        // $users = $this->getUser_feedbackForSite($feedbacks);
        // dd($users);
        // dd($feedbacks);

        $allUser = User::all();
        $allTourOwner = User::where('type', '=', 'tour_owner')->get();
        // dd(count($allUser));

        $availableTours = tour::where('available', '=', '1')->get();
        $OwnerForAvailable = $this->getOwnerForTour($availableTours);
        $numberOfBookingInForAvailable = $this->getNumberOfBookingForTour($availableTours);

        $previousTours = tour::where('available', '=', '0')->get();
        $OwnerForpreviousTours = $this->getOwnerForTour($previousTours);
        $numberOfBookingInForpreviousTours = $this->getNumberOfBookingForTour($previousTours);

        $brief = webBrief::find(1);
        $notefication = Notification::where('user_id', '=', Auth::id())->get();
        $myRegistredTour =  $this->myRegistredTour();


        return (view('main', compact(
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
            'notefication',
            'myRegistredTour'
            // 'routeName',
            // 'routeNameForDetails'
        )));
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


    // -----------------------------------Update + delete -----------------------------------------

    public function update(Request $request)
    {

        //validation ..
        $validatedData = Validator::make($request->all(), [
            'name' => 'required|string|min:3',
            'phone_number' => 'required|min:7',
            'password' => 'required|min:5',
            'setting' => 'required',
            'user_id' => [
                'required',
                Rule::in([Auth::id()]), // Validate that owner_id matches the authenticated user's ID
            ],
        ]);

        if ($validatedData->fails()) {

            // dd($validatedData);
            //
            return back()->withErrors($validatedData)->withInput();
        } else {

            if ($request->has('image')) {
                $validate = $request->validate([
                    'image' => 'required|image|mimes:png,jpg,JPEG',
                ]);
                if ($validate) {
                    $filename = "";
                    $filename = Storage::putFile('user_img', $request->file('image'));
                } else {
                    return back()->withErrors($validatedData)->withInput();
                }
            } else {
                $filename = "user_img/avatar.png";
            }


            $user = User::find($request->user_id);

            // $name = $request->name ;
            // dd($name)
            // dd($request);
            $user->update([
                'name' => $request->name,
                'phone_number' => $request->phone_number,
                'password' => Hash::make($request->password),
                'image' => $filename,
                'setting' => $request->setting,
            ]);
            // $this->userRedirect('users updated successfuly');
            toast('users updated successfuly!', 'success');
            // session()->flash('success', 'The modification was completed successfully!');
            // Session::flash('msg', 'The modification was completed successfully!');
            // Alert::success('aaa', 'Your Acount Created Successfuly');
            return redirect(url('users/AnyProfile/' . $user->id));
        }
    }

    public function delete($id)
    {

        // Validate the input data
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|exists:users,id',
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            // Handle the validation error (ID doesn't exist)
            return response()->json(['error' => 'Invalid ID or the record does not exist.'], 404);
        } else {


            $user = User::find($id);
            // ......



            Session::flash('msg', "$$user->name deleted successfuly");
            storage::delete($user->image);
            $user->delete();

            return redirect(url('curdUsers'));
        }
        // return $this->userRedirect('users deleted successfuly');
    }

    // update for Admin
    public function updateType(Request $request)
    {
        // dd($request);
        $user = User::find($request->user_id);
        $user->update([
            'type' => $request->type,
        ]);

        Session::flash('msg', "$request->name's rank has been successfully changed from $request->oldType to $request->type");


        Notification::create([
            'note' => response()->json([
                'msg' => 'Your rank has been changed from ' . $request->oldType .  ' to '  . $request->type
            ])->content(),
            'type' => 'Rank',
            'user_id' => $request->user_id,
        ]);

        return redirect(url('curdUsers'));
    }



    // -----------------------------------------  NavBAr  --------------------------------------

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

    // ------- myRegistredTour -----
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

    // ------------------------------------Profile---------------------------------------

    public function PublicProfile($id)
    {
        $user =  User::find($id);
        $listWishListTour = $this->wishListForUser();

        $Following = $this->showFolowing($id);
        $Followers = $this->showFolower($id);
        $MyPost = $this->AllPostForUser($id);
        $numberOfLikersForMyPost = $this->getnumberOfLikersForMyPost($MyPost);

        $Myfeedback = feedback::where('user_id', '=', $id)->get();

        $UserFeedBackForMyTour = $this->UserFeedBackForTour($id);
        // $FeedBackForMyTour = $this->MyFeedBackForSite();
        $brief = webBrief::find(1);
        // $ifAvailable = $this->ifFriends($id, $Following);
        $notefication = Notification::where('user_id', '=', Auth::id())->get();
        $myRegistredTour =  $this->myRegistredTour();

        $ifFriends = $this->ifFriends($id, $Following);



        return view('users.profile.publicUnfriend', compact(
            'user',
            'listWishListTour',
            'Following',
            'Followers',
            'MyPost',
            'numberOfLikersForMyPost',
            'UserFeedBackForMyTour',
            'brief',
            'notefication',
            'myRegistredTour',
            'Myfeedback',
            'ifFriends'
        ));
    }

    public function showFolowing($id)
    {
        $Folowing = follower::where('user_id', '=', $id)->get();
        // $user= User::find($request->friend_id);

        $users = [];
        for ($i = 0; $i < count($Folowing); $i++) {
            $users[$i] = User::find($Folowing[$i]->friends);
        }

        return ($users);
    }

    public function showFolower($id)
    {
        $Folowers = follower::where('friends', '=',  $id)->get();
        //duplicates

        $users = [];
        for ($i = 0; $i < count($Folowers); $i++) {
            $users[$i] = User::find($Folowers[$i]->user_id);
        }

        return ($users);
    }


    // public function profile($id)
    // {
    //     $user =  User::find(Auth::id());
    //     $listWishListTour = $this->wishListForUser();
    //     $Following = $this->showFolowing($id);
    //     $Followers = $this->showFolower($id);
    //     $MyPost = $this->MyAllPost();
    //     $numberOfLikersForMyPost = $this->getnumberOfLikersForMyPost($MyPost);
    //     $MyFeedBackForTour = $this->MyFeedBackForTour();
    //     // $MyFeedBackForSite = $this->MyFeedBackForSite();
    //     $brief = webBrief::find(1);
    //     $ifFriends = $this->ifFriends($id, $Following);
    //     $notefication = Notification::where('user_id', '=', Auth::id())->get();
    //     $myRegistredTour =  $this->myRegistredTour();


    //     dd($ifFriends);

    //     return view('users.profile.publicUnfriend.blade', compact(
    //         'user',
    //         'listWishListTour',
    //         'Following',
    //         'Followers',
    //         'MyPost',
    //         'numberOfLikersForMyPost',
    //         'MyFeedBackForTour',
    //         // 'MyFeedBackForSite',
    //         'brief',
    //         'ifFriends',
    //         'notefication',
    //         'myRegistredTour'
    //     ));
    // }


    public function ifFriends($id, $Following)
    {

        for ($i = 0; $i < count($Following); $i++)
            if ($Following[$i] == $id)
                return true;
        // return false
        return false;
        //

    }


    // Post :

    // public function createPost()
    // {
    //     return view('users.profile.post.create');
    // }

    public function storePost(Request $request)
    {

        $filename2 = Storage::putFile('user_img', $request->file('image'));
        // return $filename;
        Post::create([
            'user_id' => Auth::id(),
            'description' => $request->description,
            'image' => $filename2,
        ]);

        // Session::flash('msg', 'post created successfuly');
        toast('post created successfuly!', 'success');
        return back();
    }

    public function  AllPostForUser($id)
    {
        $allPost = Post::where('user_id', '=', $id)->get();
        return  $allPost;
    }

    public function getnumberOfLikersForMyPost($MyPosts)
    {
        $number = [];
        // dd($AlltoursSuggest);
        for ($i = 0; $i < count($MyPosts); $i++) {

            $post = LikersForPost::where('post_id', '=', $MyPosts[$i]->id)->get();

            if ($post != null) {
                $number[$i] = count($post);
            } else
                $number[$i] = 0;
        }
        // dd($number);
        return $number;
    }


    //feedBack

    public function showAllFeedBack()
    {

        $FeedBackForTour = $this->MyFeedBackForTour();
        // $FeedBackForSite = $this->MyFeedBackForSite();
        $notefication = Notification::where('user_id', '=', Auth::id())->get();

        // dd(count($MyFeedBackForSite));
        return view('feedback.showMyFeedback', compact(
            'FeedBackForTour',
            // 'FeedBackForSite',
            'notefication'
        ));
    }

    public function UserFeedBackForTour($id)
    {

        $feedBackTour  = feedback::where('tour_id', '=', $id)->get(); // feedack
        $feedBack  = [];
        for ($i = 0; $i < count($feedBackTour); $i++) {
            $feedBack[$i] = $feedBackTour[$i];
        }

        $users = [];
        for ($i = 0; $i < count($feedBackTour); $i++) {
            $users[$i] = User::find($feedBackTour[$i]->user_id);
        }
        // dd($feedBackTour);
        $FeedBackForMyTour = array_merge($users, $feedBack);
        $FeedBackForMyTour_json = json_encode($FeedBackForMyTour);

        return  $FeedBackForMyTour_json;
    }
}
