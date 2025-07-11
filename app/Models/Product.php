<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, HasSlug;

    protected $slugSourceColumn = 'name';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    protected $casts = [
        'category_id' => 'array', // Cast category_id as an array
    ];


    public function categories()
    {
         if (empty($this->category_id)) {
            return collect();
        }

        // Decode the category_id if it's a JSON string, or use it directly if it's an array
        $categoryIds = is_string($this->category_id)
            ? json_decode($this->category_id, true)
            : $this->category_id;

         if (!is_array($categoryIds)) {
            $categoryIds = [];
        }

        return Category::whereIn('id', $categoryIds)->get();
    }

    // Correct `belongsTo` relationship should be used for single category or brand
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class, 'product_id');
    }

    public function multiImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }
    public function sizes()
    {
        return $this->hasMany(ProductSizeStock::class, 'product_id');
    }
    public function reviews()
    {
        return $this->hasMany(ProductReview::class, 'product_id');
    }
    public function scopeActive($query)
    {
        return $query->where('status', 'published');
    }
    public function deals()
    {
        return $this->hasMany(DealBanner::class, 'brand_id');
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
