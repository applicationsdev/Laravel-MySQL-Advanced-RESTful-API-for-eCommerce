<?php

namespace App;

// Requires
use Illuminate\Database\Eloquent\Model;
use App\Item;
use App\Order;

class OrderItem extends Model
{
    // Mass assignable attributes
    protected $fillable = [
        'qty',
        'value',
        'item_id',
        'order_id',
    ];
    
    // DB relationships
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
