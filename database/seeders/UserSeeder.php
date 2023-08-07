<?php

namespace Database\Seeders;

use App\Models\tour;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // User::create([
        //     'name'=>'noor' ,
        //     'email'=>'noor@gmail.com' ,
        //     'password'=>Hash::make('123'),
        //     'image'=>'user_img/vIlVaQCgaFApxaqOxJLQYUqY8jHiCnJ7PzHesLEY.jpg'
        // ]);
        User::create([
            'name'=>'noor' ,
            'email'=>'noor1@gmail.com' ,
            'password'=>Hash::make('123'),
            'image'=>'user_img/vIlVaQCgaFApxaqOxJLQYUqY8jHiCnJ7PzHesLEY.jpg'
        ]);
        User::create([
            'name'=>'noor' ,
            'email'=>'noor2@gmail.com' ,
            'password'=>Hash::make('123'),
            'image'=>'user_img/vIlVaQCgaFApxaqOxJLQYUqY8jHiCnJ7PzHesLEY.jpg'
        ]);
        User::create([
            'name'=>'noor' ,
            'email'=>'noor3@gmail.com' ,
            'password'=>Hash::make('123'),
            'image'=>'user_img/vIlVaQCgaFApxaqOxJLQYUqY8jHiCnJ7PzHesLEY.jpg'
        ]);

        // User::create([
        //     'name'=>'mhanna' ,
        //     'email'=>'mhanan@gmail.com' ,
        //     'password'=>Hash::make('123'),
        //     'image'=>'user_img/vIlVaQCgaFApxaqOxJLQYUqY8jHiCnJ7PzHesLEY.jpg'
        // ]);

        User::create([
            'name'=>'mhanna' ,
            'email'=>'mhanan1@gmail.com' ,
            'password'=>Hash::make('123'),
            'image'=>'user_img/vIlVaQCgaFApxaqOxJLQYUqY8jHiCnJ7PzHesLEY.jpg'
        ]);

        User::create([
            'name'=>'mhanna' ,
            'email'=>'mhanan2@gmail.com' ,
            'password'=>Hash::make('123'),
            'image'=>'user_img/vIlVaQCgaFApxaqOxJLQYUqY8jHiCnJ7PzHesLEY.jpg'
        ]);

        // --------------------------


    }
}
