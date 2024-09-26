<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Catalog;

class Category extends Model
{
    use HasFactory;

    public $additional_attributes = ['name_w_catalog'];

    public function catalog()
    {
        return $this->belongsTo(Catalog::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getNameWCatalogAttribute()
    {
        return ($this->name . ' - ' . $this->catalog->name); 
    }
}
