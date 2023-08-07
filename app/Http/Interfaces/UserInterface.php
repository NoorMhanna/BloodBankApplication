<?php

namespace App\Http\Interfaces;

use App\Http\Requests\crateUserRequest;
use App\Http\Requests\deleteUserRequest;

interface UserInterface{
public function index();
public function create();
public function store(crateUserRequest $request);
public function edit($id);
public function update(crateUserRequest $request);
public function destroy(deleteUserRequest $request);

}


?>
