<?php

namespace App;

// Requires
use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Merchant;
use App\OrderItem;

class Item extends Model
{
    // Mass assignable attributes
    protected $fillable = [
        'title',
        'image_thumbnail',
        'description_short',
        'available_qty',
        'catalog_price',
        'status',
        'category_id',
        'merchant_id'
    ];
    
    // DB relations
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }
    
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
