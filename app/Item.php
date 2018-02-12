<?php

namespace App;

// Requires
use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Merchant;
use App\OrderItem;

// To simplify testing, a simple Item model is designed in current version
// Real-scale eCommerce apps may use many Item attributes & features (ex. discounts etc)

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
        'merchant_id',
    ];
    
    // DB relationships
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
    
    // 'status' checkers
    public function isNotActive()
    {
        return $this->status == Config::get('customConstants.item.status.is_not_active');
    }
    public function isNotAvailable()
    {
        return $this->status == Config::get('customConstants.item.status.is_not_available');
    }
    public function isAvailable()
    {
        return $this->status == Config::get('customConstants.item.status.is_available');
    }
}
