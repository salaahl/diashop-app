<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Catalog;
use App\Models\Order;
use App\Models\Brand;

class Product extends Model
{
    use HasFactory;

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

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

    // Permet de récupérer les utilisateurs ayant mis le produit en favori
    public function favorites()
    {
        return $this->belongsToMany(User::class);
    }
}
