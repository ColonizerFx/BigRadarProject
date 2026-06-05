<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'brand',
        'description',
        'image_path',
    ];

    public function retailers()
    {
        return $this->belongsToMany(Retailer::class)
                    ->withPivot('price', 'availability_status', 'product_url')
                    ->withTimestamps();
    }
}
