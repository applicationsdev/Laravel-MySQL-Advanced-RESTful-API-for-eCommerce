<?php

namespace App;

// Requires
use Illuminate\Database\Eloquent\Model;
use App\Item;

class Category extends Model
{
    // Mass assignable attributes
    protected $fillable = [
        'title',
        'image_thumbnail',
        'description_short',
        'status',
    ];
    
    // DB relationships
    public function items()
    {
        return $this->hasMany(Item::class);
    }
    
    // 'status' checkers
    public function isNotActive()
    {
        return $this->status == Config::get('customConstants.category.status.is_not_active');
    }
    public function isActive()
    {
        return $this->status == Config::get('customConstants.category.status.is_active');
    }
}
