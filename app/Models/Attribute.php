<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];
    protected $casts = [
        'name'   => 'string',
    ];
    public $with = ['values'];
    public function values()
    {
        return $this->hasMany(AttributeValues::class);
    }

}
