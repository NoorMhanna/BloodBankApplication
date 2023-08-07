<?php

namespace Database\Seeders;

use App\Models\FeedbackForSite;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeedbackSiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        FeedbackForSite::create([
            'user_id'=>'1',
            'comment'=>'Booking your tour',
            'name'=>'Bessan salah',
        ]);

        FeedbackForSite::create([
            'user_id'=>'2',
            'comment'=>'Booking your tour',
            'name'=>'Noor mhanna',
        ]);

        FeedbackForSite::create([
            'user_id'=>'3',
            'comment'=>'Booking your tour',
            'name'=>'Ahmad salah',
        ]);
    }
}
