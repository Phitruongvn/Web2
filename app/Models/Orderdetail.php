<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'orderdetail';
    
    public $timestamps = false;
    
    protected $fillable = [
        'order_id',
        'product_id',
        'price',
        'qty',
        'amount',
        'discount'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Thêm accessor để lấy thumbnail từ product
    public function getThumbnailAttribute()
    {
        return $this->product ? $this->product->thumbnail : null;
    }
}
