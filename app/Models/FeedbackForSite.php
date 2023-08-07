<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedbackForSite extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'comment'
    ];
}
