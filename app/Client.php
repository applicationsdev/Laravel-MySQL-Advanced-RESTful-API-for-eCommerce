<?php

namespace App;

// Requires
use App\Order;

class Client extends User
{
    // DB relationships
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
