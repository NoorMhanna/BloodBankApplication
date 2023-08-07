<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class createUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // public function authorize(): bool
    // {
    //     return true;
    // }

    public function rules()
    {
        return [
            // 'name'=> 'required|min:3',
            'name_en' => 'required_without_all:name_ar|string',
            'name_ar' => 'required_without_all:name_en|string',
            'email'=> 'required|unique:users,email',
            'phone_number'=> 'required',
            'password'=>'required|min:5',
            'city'=> 'required',
            'coords_lat'=> 'required',
            'coords_lng'=> 'required',
            'image'=> 'required|image|mimes:png,jpg,JPEG',
        ];
    }
}
