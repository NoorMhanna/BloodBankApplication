<?php

namespace Database\Seeders;

use App\Models\service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        service::create([
            'icon'=>'fa-solid fa-circle-info',
            'title'=>'Show tours details',
            'description'=>'Consequuntur sunt aut quasi enim aliquam quae harum pariatur laboris nisi ut
            aliquip',
        ]);

        service::create([
            'icon'=>'fa-regular fa-gem',
            'title'=>'Booking your tour',
            'description'=>'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
            deserun',
        ]);

        service::create([
            'icon'=>'fa-regular fa-lightbulb',
            'title'=>'Share your tours',
            'description'=>'Aut suscipit aut cum nemo deleniti aut omnis. Doloribus ut maiores omnis facere',
        ]);
    }
}
