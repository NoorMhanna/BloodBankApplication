<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tour extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'source',
        'destination',
        'latitude',
        'longitude',
        'description',
        'dateOFTour',
        'price',
        'max_participate',
        'available',
        'images',
        'path',
        'ActivityAndTime',
        'short_description'
    ];


    // public function pictures(){
    //     return $this->hasMany(picture::class); // one to one , user with feedBack ;
    // }

    // public function Owner(){
    //     return $this->belongsTo(User::class);
    // }




}
