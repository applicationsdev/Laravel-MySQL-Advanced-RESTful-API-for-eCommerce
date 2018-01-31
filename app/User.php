<?php

// SECURITY WARNING: hardened settings can be applied in production environments

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    
    // Specify in explicit way the DB table that is associated with the model
    protected $table = 'users';
    
    // Mass assignable attributes
    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    // Hidden attributes from model array & JSON representations
    protected $hidden = [
        'password',
        'verify_token',
        //'state', // Uncomment this attribute in production environment
        'remember_token'
    ];
    
    protected function createVerifyToken()
    {
        return str_random(12);
    }
}
