<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Vendor extends Model implements HasMedia
{
    use HasFactory , InteractsWithMedia;
    const PATH = 'vendors';
    protected $fillable = [
        'name',
        'description',
        'slug',
        'latitude',
        'longitude',
        'address',
        'phone',
        'email',
        'is_active',
        'vendor_category_id',
        'city_id'
    ];
    protected $casts = [
        'name'              => 'string',
        'description'       => 'string',
        'slug'              => 'string',
        'latitude'          => 'double',
        'longitude'         => 'double',
        'address'           => 'string',
        'phone'             => 'integer',
        'email'             => 'string',
        'is_active'         => 'boolean',
        'vendor_category_id'=> 'integer',
        'city_id'           => 'integer',
    ];
    public function features()
    {
        return $this->morphMany(Feature::class, 'featureable');
    }
    public function vendorCategory()
    {
        return $this->belongsTo(VendorCategory::class);
    }
    public function banner()
    {
        return $this->hasOne(Banner::class);
    }
    public function scopeFilter($query)
    {
        $newQuery = $query;

        $newQuery = $newQuery
            ->when(request()->has('is_active'), function ($query) {
                return $query->where('is_active', request()->is_active);
            })
            ->when(request()->has('search'), function ($query) {
                return $query->where('name', 'like', '%' . request()->search . '%');
            })
            ->when(request()->has('order_by_id'), function ($query) {
                $sortOrder = request()->order_by_id == '1' ? 'ASC' : 'DESC';
                return $query->orderBy('id', $sortOrder);
            })
            ->when(request()->has('recent'), function ($query) {
                $sortOrder = request()->recent == '1' ? 'ASC' : 'DESC';
                return $query->orderBy('created_at', $sortOrder);
            });

        return $newQuery;
    }
}
