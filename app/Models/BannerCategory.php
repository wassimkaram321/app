<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'is_active'
    ];
    protected $casts = [
        'type'   => 'string',
        'is_active'   => 'boolean',
    ];
    public function banners()
    {
        return $this->hasMany(Banner::class);
    }
    public function scopeFilter($query)
    {
        $newQuery = $query;
        
        $newQuery = $newQuery
            ->when(request()->has('is_active'), function ($query) {
                return $query->where('is_active', request()->is_active);
            })
            ->when(request()->has('search'), function ($query) {
                return $query->where('type', 'like', '%' . request()->search . '%');
            })
            ->when(request()->has('order_by_id'), function ($query) {
                $sortOrder = request()->order_by_id == '1' ? 'ASC' : 'DESC';
                return $query->orderBy('id' . request()->lang, $sortOrder);
            })
            ->when(request()->has('recent'), function ($query) {
                $sortOrder = request()->recent == '1' ? 'ASC' : 'DESC';
                return $query->orderBy('created_at', $sortOrder);
            });

        return $newQuery;
    }
}
