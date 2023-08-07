<?php

namespace Database\Seeders;

use App\Models\tour;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class tourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        tour::create([
            'name'=>'ram',
            'source'=>'source _____ ',
            'destination'=>'destination __________ ',
            'description'=> 'description____ ' ,
            'dateOFTour' => '2023-04-30',
            'max_participate' => '20',
            'user_id' => '1',
            'price'=> '200' ,
        ]);
    }
}
