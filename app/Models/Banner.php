<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Banner extends Model implements HasMedia
{
    use HasFactory , InteractsWithMedia;
    const PATH = "banners";
    protected $fillable = [
        'start_date',
        'end_date',
        'is_active',
        'banner_category_id',
        'vendor_id',
    ];
    protected $casts = [
        'start_date'           => 'date',
        'end_date'             => 'date',
        'is_active'            => 'boolean',
        'banner_category_id'   => 'integer',
        'vendor_id'            => 'integer',
    ];
    public function bannerCategory()
    {
        return $this->belongsTo(BannerCategory::class);
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
            ->when(request()->has('search'), function ($query) {
                return $query->where('name', 'like', '%' . request()->search . '%');
            })
            ->when(request()->has('order_by_id'), function ($query) {
                $sortOrder = request()->order_by_id == '1' ? 'ASC' : 'DESC';
                return $query->orderBy('id', $sortOrder);
            })
            ->when(request()->has('start_date'), function ($query) {
                $sortOrder = request()->start_date == '1' ? 'ASC' : 'DESC';
                return $query->orderBy('start_date', $sortOrder);
            })
            ->when(request()->has('end_date'), function ($query) {
                $sortOrder = request()->end_date == '1' ? 'ASC' : 'DESC';
                return $query->orderBy('end_date', $sortOrder);
            })
            ->when(request()->has('recent'), function ($query) {
                $sortOrder = request()->recent == '1' ? 'ASC' : 'DESC';
                return $query->orderBy('created_at', $sortOrder);
            });

        return $newQuery;
    }


}
