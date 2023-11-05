<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Space extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'is_active',
        'space',
        'floor_id'
    ];
    protected $casts = [
        'name'        => 'string',
        'is_active'   => 'boolean',
        'space'       => 'integer',
        'floor_id'    => 'integer',
    ];
    public function floor()
    {
        return $this->belongsTo(Floor::class);
    }
}
