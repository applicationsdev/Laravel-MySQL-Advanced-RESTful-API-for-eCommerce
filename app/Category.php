<?php

namespace App;

// Requires
use Illuminate\Database\Eloquent\Model;
use App\Item;

class Category extends Model
{
    // Mass assignable attributes
    protected $fillable = ['title'];
    
    // DB relations
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
