<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialOffer extends Model
{
    use HasFactory, HasSlug;
    protected $slugSourceColumn = 'name';
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
    public function products()
    {
        // Decode the JSON product_ids
        $productIds = json_decode($this->product_id, true);
        if (!empty($productIds)) {
            return Product::whereIn('id', $productIds)->get();
        }

        return collect();
    }
}
