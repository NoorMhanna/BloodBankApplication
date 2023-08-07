<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'user_id',
        'star',
        'tour_id'
    ];

    public function users(){ // (one to one ) each feedback one user ... belongsTo
        return $this->belongsTo(User::class);
    }

}
