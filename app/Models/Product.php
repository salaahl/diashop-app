<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Option;
use App\Models\Order;
use App\Models\Favorite;
use App\Models\Brand;

class Product extends Model
{
    use HasFactory;

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
}
