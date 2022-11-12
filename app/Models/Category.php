<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ["type", "primary_category_id"];

    public function primaryCategory()
    {
        return $this->belongsTo(PrimaryCategory::class);
    }
}
