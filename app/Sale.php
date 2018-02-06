<?php

namespace App;

// Requires
use Illuminate\Database\Eloquent\Model;
use App\OrderItem;
use App\Merchant;

class Sale extends Model
{
    // Mass assignable attributes
    protected $fillable = [
        'value',
        'status',
        'merchant_id',
    ];
    
    // DB relations
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    
    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }
}
