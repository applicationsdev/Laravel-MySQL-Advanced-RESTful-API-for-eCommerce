<?php

// SECURITY WARNING: hardened settings can be applied in production environments

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    
    // Specify in explicit way the DB table that is associated with this model
    protected $table = 'users';
    
    // Mass assignable attributes
    protected $fillable = [
        'name',
        'email',
        'password',
        'photo',
        'address_line1',
        'address_line2',
        'country_code',
        'postal_code',
        'tel',
    ];

    // Hidden attributes from model array & JSON representations
    protected $hidden = [
        'password',
        'verify_token',
        //'state', // Uncomment this attribute in production environment
        'remember_token',
    ];
    
    // Token generator for User 'state' verification (Account, Merchant, Moderator)
    public function createVerifyToken()
    {
        return str_random(12); // Longer token can be used in production environment
    }
    
    // 'state' checkers (part of security policy)
    // To simplify testing of current app version (development-testing environment),
    // only some of User 'state' checkers are included
    public function isNotVerified()
    {
        return $this->state == Config::get('customConstants.user.state.is_not_verified');
    }
    public function isNotActive()
    {
        return $this->state == Config::get('customConstants.user.state.is_not_active');
    }
    public function isBlocked()
    {
        return $this->state == Config::get('customConstants.user.state.is_blocked');
    }
    public function isClient()
    {
        return $this->state == Config::get('customConstants.user.state.is_client');
    }
    public function isMerchant()
    {
        return $this->state == Config::get('customConstants.user.state.is_merchant');
    }
}
