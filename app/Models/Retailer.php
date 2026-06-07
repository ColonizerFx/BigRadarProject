<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retailer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'website_url',
        'logo_path',
        'location',
        'latitude',
        'longitude',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)
                    ->withPivot('price', 'availability_status', 'product_url')
                    ->withTimestamps();
    }
}
