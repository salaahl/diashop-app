<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use CloudinaryLabs\CloudinaryLaravel\MediaAlly;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Catalog;

class Category extends Model
{
    use HasFactory, MediaAlly;

    public function catalog()
    {
        return $this->belongsTo(Catalog::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
