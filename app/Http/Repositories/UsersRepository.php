<?php

namespace App\Http\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Interfaces\UserInterface;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
// use App\Helpers\UserTrait;


class UsersRepository implements UserInterface
{

    public $userModel;

    public function __construct(User $user)
    {
        $this->userModel = $user;
    }


    //
    public function index()
    {
        $users = $this->userModel::get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store($request)
    {
        // solid responsible.....

        $filename = Storage::putFile('user_img', $request->file('image'));

        // return $filename;

        $this->userModel::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
            'image' => $filename
        ]);

        Session::flash('msg', 'users created successfuly');
        return redirect(url('users'));
    }

    public function edit($id)
    {
        $user = $this->userModel::find($id);
        // dd($user);
        return view('users.edit', compact('user'));
    }

    public function update($request)
    {

        $user = $this->userModel::find($request->user_id);
        if ($request->has('image')) {
            storage::delete($user->image);
            $filename = Storage::putFile('user_img', $request->file('image'));
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
            'image' => $filename,
        ]);
        return $this->userRedirect('users updated successfuly');
    }


    public function destroy($request)
    {
        $user = $this->userModel::find($request->user_id);
        storage::delete($user->image);
        $user->delete();
        return $this->userRedirect('users deleted successfuly');
    }

    private function userRedirect($msg){
        Session::flash('msg', $msg);
        return redirect(url('users'));
    }
}
