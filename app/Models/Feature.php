<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'content',
        'is_active',
        'featureable_id',
        'featureable_type',
    ];
    protected $casts = [
        'title'              => 'string',
        'content'            => 'string',
        'is_active'          => 'boolean',
        'featureable_id'     => 'integer',
        'featureable_type'   => 'string',
    ];
    public function featureable()
    {
        return $this->morphTo();
    }
}
