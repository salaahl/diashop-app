<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Size;

class Option extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'img_thumbnail' => 'array',
        'img_fullsize' => 'array',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function sizes()
    {
        return $this->hasMany(Size::class);
    }
}
