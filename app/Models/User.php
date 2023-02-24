<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject; //implementar esto

class User extends Authenticatable implements JWTSubject //y tambien implementar el JWTSUbject
{
    use HasFactory, Notifiable; // esto tambien se implementa y eliminamos el use laravel,hasapitokens

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

    //dos funciones para el indfentificador que se tienen que implementar
    public function getJWTIdentifier(){
        return $this->getKey();
    }

    public function getJWTCustomClaims(){
        return [];
    }

    public function isAdmin(){
        //esrto seria una funcion para omprobar si el usuario es administrador o no
        return $this->rol == 1;
    }

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
