<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
        'activo' =>'boolean',
    ];

    //relacion 1 a muchos de la tabla post, un usuario tiene muchos post
    public function posts(){
        return $this->hasMany(Post::class);
    }

    //es phone porque es una relacion 1 : 1, un usuario tiene un telefono
    public function phone(){
        //return $this->hasMany(Phone::class);
        return $this->hasOne(Phone::class); //asi seria si el usuario solo tiene un telefono y ña funcion solo se llamaria phone no phones
    }


}
