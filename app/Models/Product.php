<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Brand;


class Product extends Model
{
    use SoftDeletes;

    protected $table = 'product';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'content',
        'thumbnail',
        'price_buy',
        'price_sale',
        'qty',
        'category_id',
        'brand_id',
        'status',
        'created_by'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
    public function scopeFilter(Builder $query, $filters)
    {
        if (!empty($filters['search'])) {
            $query->where('name', 'LIKE', '%' . $filters['search'] . '%');
        }

        if (!empty($filters['price_min'])) {
            $query->where('price_buy', '>=', $filters['price_min']);
        }

        if (!empty($filters['price_max'])) {
            $query->where('price_buy', '<=', $filters['price_max']);
        }

        if (!empty($filters['brand'])) {
            $query->whereHas('brand', function ($q) use ($filters) {
                $q->where('slug', $filters['brand']);
            });
        }

        if (!empty($filters['category'])) {
            $query->whereHas('category', function ($q) use ($filters) {
                $q->where('slug', $filters['category']);
            });
        }

        return $query;
    }

    public function scopeSort(Builder $query, $sortBy)
    {
        if ($sortBy === 'price_asc') {
            $query->orderBy('price_buy', 'asc');
        } elseif ($sortBy === 'price_desc') {
            $query->orderBy('price_buy', 'desc');
        } elseif ($sortBy === 'newest') {
            $query->orderBy('created_at', 'desc');
        }

        return $query;
    }
}
