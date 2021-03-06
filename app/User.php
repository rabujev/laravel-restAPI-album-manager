<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject; // Why the JWTSubject? aah https://jwt-auth.readthedocs.io/en/docs/quick-start/

class User extends Authenticatable implements JWTSubject   //Why? aah https://jwt-auth.readthedocs.io/en/docs/quick-start/
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /** //From the tuto (Jam)
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
     public function getJWTIdentifier()
     {
         return $this->getKey();
     }

     public function getJWTCustomClaims()
     {
         return [];
     }
     // public function setPasswordAttribute($password)
     // {
     //     if ( !empty($password) ) {
     //         $this->attributes['password'] = bcrypt($password);
     //     }
     // }
}
