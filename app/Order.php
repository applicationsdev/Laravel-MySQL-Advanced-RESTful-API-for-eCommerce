<?php

namespace App;

// Requires
use Illuminate\Database\Eloquent\Model;
use App\Sale;
use App\Client;

class Order extends Model
{
    // Mass assignable attributes
    protected $fillable = [
        'value',
        'status',
        'client_id'
    ];
    
    // DB relations
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
    
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
