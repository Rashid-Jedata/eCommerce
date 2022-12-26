<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    protected $table = 'category';
    use HasFactory;
    protected $fillable = ['name', 'category_mainImage'];



    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
