<?php

namespace App;

// Requires
use Illuminate\Database\Eloquent\Model;
use App\Item;
use App\Sale;

class OrderItem extends Model
{
    // Mass assignable attributes
    protected $fillable = [
        'qty',
        'value',
        'item_id',
        'sale_id'
    ];
    
    // DB relations
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
    
    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
}
