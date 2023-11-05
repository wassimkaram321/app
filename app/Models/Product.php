<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    const PATH = 'products';
    protected $fillable = [
        'uuid',
        'name',
        'description',
        'price',
        'slug',
        'quantity',
        'vendor_id',
        'is_active',
        'is_returnable',
        'is_cancelable',
        'is_replaceable',
        'categorizable_id',
        'categorizable_type',
        'availability',
        'commission_id',
        'commission_value',
    ];
    protected $casts = [
        'name'                => 'string',
        'description'         => 'string',
        'price'               => 'double',
        'slug'                => 'string',
        'quantity'            => 'integer',
        'vendor_id'           => 'integer',
        'is_active'           => 'boolean',
        'is_returnable'       => 'boolean',
        'is_cancelable'       => 'boolean',
        'is_replaceable'      => 'boolean',
        'categorizable_id'    => 'integer',
        'categorizable_value' => 'string',
        'availability'        => 'string',
        'commission_id'       => 'integer',
        'commission_value'    => 'float',
    ];
    public function features()
    {
        return $this->morphMany(Feature::class, 'featureable');
    }
    public function categorizable()
    {
        return $this->morphTo();
    }
    public function commission()
    {
        return $this->belongsTo(Commission::class);
    }
    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'product_attributes')->withPivot('selected_value', 'quantity');
    }
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
    public function scopeFilter($query)
    {
        $newQuery = $query;

        $newQuery = $newQuery
            ->when(request()->has('is_active'), function ($query) {
                return $query->where('is_active', request()->is_active);
            })
            ->when(request()->has('order_by_id'), function ($query) {
                $sortOrder = request()->order_by_id == '1' ? 'ASC' : 'DESC';
                return $query->orderBy('id', $sortOrder);
            })
            ->when(request()->has('price'), function ($query) {
                $sortOrder = request()->price == '1' ? 'ASC' : 'DESC';
                return $query->orderBy('price', $sortOrder);
            })
            ->when(request()->has('quantity'), function ($query) {
                $sortOrder = request()->quantity == '1' ? 'ASC' : 'DESC';
                return $query->orderBy('quantity', $sortOrder);
            })
            ->when(request()->has('recent'), function ($query) {
                $sortOrder = request()->recent == '1' ? 'ASC' : 'DESC';
                return $query->orderBy('created_at', $sortOrder);
            });
            if (request()->has('search')) {
                $searchTerm = request()->search;
                $newQuery->where(function ($query) use ($searchTerm) {
                    $query->where('name', 'like', '%' . $searchTerm . '%');
                });
            }
        return $newQuery;
    }
}
