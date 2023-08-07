<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Translatable\HasTranslations;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable ;
    // use HasTranslations  ;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'image',
        'setting',
        'type',
        // 'city',
        // 'coords_lat' ,
        // 'coords_lng'
    ];



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function feedBack(){
        return $this->hasMany(feedback::class); // one to one , user with feedBack ;
    }

    public function wishList(){
        return $this->hasMany(wishlist::class); // one to one , user with wishlist ;
    }


    public function toursForOwner(){
        return $this->hasMany(tour::class);
    }

    public function ownerTouur(){ // (one to one ) each wishlist one user ... belongsTo
        return $this->belongsTo(ownerTouur::class);
    }
}
