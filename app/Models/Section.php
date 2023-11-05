<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'space',
        'position',
        'space_id',
        'vendor_category_id',
        'is_active'
    ];
    protected $casts = [
        'name'               => 'string',
        'space'              => 'integer',
        'position'           => 'string',
        'space_id'           => 'integer',
        'vendor_category_id' => 'integer',
        'is_active'          => 'boolean',
    ];
}
