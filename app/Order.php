<?php

namespace App;

// Requires
use Illuminate\Database\Eloquent\Model;
use App\OrderItem;
use App\Client;

class Order extends Model
{
    // Mass assignable attributes
    protected $fillable = [
        'value',
        'status',
        'client_id',
    ];
    
    // DB relations
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
