<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class suggestTour extends Model
{
    use HasFactory;
    protected $fillable = [
        // 'name',
        // 'city',
        'destination',
        'user_id',
        // 'timeLeft',

    ];

}




    // public function users(){
    //     return $this->belongsToMany(User::class)
    //     ->withPivot('time_min')->withTimestamps();
    // }

    //uses: $user->exams()->attach($id)
