<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Catalog;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'quantity_per_size' => 'array',
        'img' => 'array',
    ];

    public function catalog()
    {
        return $this->belongsTo(Catalog::class);
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
