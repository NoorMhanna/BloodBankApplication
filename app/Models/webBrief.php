<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class webBrief extends Model
{
    use HasFactory;


    protected $fillable = [
        'admin_id',
        'brief',
        'image',
        'call',
        'email'
    ];

}
