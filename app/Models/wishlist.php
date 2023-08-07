<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wishlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tour_id'
    ];


    public function users(){ // (one to one ) each wishlist one user ... belongsTo
        return $this->belongsTo(User::class);
    }

}
