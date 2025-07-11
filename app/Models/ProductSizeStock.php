<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSizeStock extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    protected $casts = [
        'size' => 'integer',
        'stock' => 'integer',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
