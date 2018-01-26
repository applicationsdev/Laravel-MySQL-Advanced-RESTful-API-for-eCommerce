<?php

namespace App;

// Requires
use App\Item;
use App\Sale;

class Merchant extends User
{
    // DB relations
    public function items()
    {
        return $this->hasMany(Item::class);
    }
    
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
