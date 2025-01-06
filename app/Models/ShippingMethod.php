<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model
{
    use HasFactory, HasSlug;
    protected $slugSourceColumn = 'title';

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
    public function order()
    {
        return $this->belongsTo(Order::class, 'shipping_method_id');
    }
}
