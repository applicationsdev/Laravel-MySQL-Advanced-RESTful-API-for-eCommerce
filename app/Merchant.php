<?php

namespace App;

// Requires
use App\Item;

class Merchant extends User
{
    // DB relationships
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
