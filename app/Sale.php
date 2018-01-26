<?php

namespace App;

// Requires
use Illuminate\Database\Eloquent\Model;
use App\OrderItem;
use App\Order;
use App\Merchant;

class Sale extends Model
{
    // Mass assignable attributes
    protected $fillable = [
        'value',
        'status',
        'order_id',
        'merchant_id'
    ];
    
    // DB relations
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    
    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }
}
