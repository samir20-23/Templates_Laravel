<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ["title", "description", "price", "img_path", "stock"];

    // Scope for filtering products by price range
    public function scopePriceRange($query, $minPrice, $maxPrice)
    {
        return $query->whereBetween('price', [$minPrice, $maxPrice]);
    }

    // Scope for filtering products that are in stock
    public function scopeInStock($query)
    {
        return $query->where('stock', '>', 0);
    }

    // Scope for searching products by title (case-insensitive)
    public function scopeSearch($query, $searchTerm)
    {
        return $query->where('title', 'like', '%' . $searchTerm . '%');
    }
}
