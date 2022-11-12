<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'price'
    ];
    public function productCategory()
    {
        return $this->hasMany(ProductCategory::class);
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function availableColors()
    {
        return $this->hasMany(ProductColor::class);
    }
    public function availableSizes()
    {
        return $this->hasMany(ProductSize::class);
    }
}
