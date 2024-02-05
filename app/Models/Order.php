<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\User;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'products' => 'array',
        'billing_address' => 'array',
        'shipping_address' => 'array',
        'ammount' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
