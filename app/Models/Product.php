<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Catalog;
use App\Models\Order;

class Product extends Model
{
    use HasFactory;

    public function catalog()
    {
        return $this->belongsTo(Catalog::class);
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
}
