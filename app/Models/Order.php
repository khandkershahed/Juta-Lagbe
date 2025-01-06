<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
    public function shippingCharge()
    {
        return $this->belongsTo(ShippingMethod::class, 'shipping_method_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
    public function scopeProcessing($query)
    {
        return $query->where('status', 'processing');
    }
    public function scopeShipped($query)
    {
        return $query->where('status', 'shipped');
    }
    public function scopeDelivered($query)
    {
        return $query->where('status', 'delivered');
    }
    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }
    public function scopeReturned($query)
    {
        return $query->where('status', 'returned');
    }

}
