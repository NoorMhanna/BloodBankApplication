<?php

namespace Database\Seeders;

use App\Models\webBrief;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class briefSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        webBrief::create([
            'id'=>'1',
            'brief'=>"Day on Palestine<br>With YallaRehlla",
            'image'=>'brofile.jpg',
            'call'=> '+972-583764823',
            'email'=>'YallaRehla@gmail.com',
        ]);
    }
}
