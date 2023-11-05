<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'is_active'
    ];
    protected $casts = [
        'name'        => 'string',
        'is_active'   => 'boolean',
    ];
    public function spaces()
    {
        return $this->hasMany(Space::class);
    }
}
