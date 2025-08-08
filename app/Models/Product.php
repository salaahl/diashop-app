<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use CloudinaryLabs\CloudinaryLaravel\MediaAlly;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Catalog;

class Product extends Model
{
    use HasFactory, MediaAlly;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'quantity_per_size' => 'array',
        'img' => 'array',
    ];

    // Accessor : pour l’interface d’administration uniquement
    public function getImgAttribute($value)
    {
        // Si tu es dans Voyager (admin), retourne une chaîne JSON
        if (request()->is('admin/*')) {
            if (is_array($value)) {
                return json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            }

            return $value;
        }

        // Sinon (sur le site normal), retourne bien l’array
        return json_decode($value, true);
    }

    public function getQuantityPerSizeAttribute($value)
    {
        // Si tu es dans Voyager (admin), retourne une chaîne JSON
        if (request()->is('admin/*')) {
            if (is_array($value)) {
                return json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            }

            return $value;
        }

        // Sinon (sur le site normal), retourne bien l’array
        return json_decode($value, true);
    }

    public function catalog()
    {
        return $this->belongsTo(Catalog::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
