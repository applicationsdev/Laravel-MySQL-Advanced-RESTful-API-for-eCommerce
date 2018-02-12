<?php

namespace App;

// Requires
use Illuminate\Database\Eloquent\Model;
use App\Client;
use App\OrderItem;

class Order extends Model
{
    // Mass assignable attributes
    protected $fillable = [
        'value',
        'status',
        'client_id',
    ];
    
    // DB relationships
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
