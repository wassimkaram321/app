<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValues extends Model
{
    use HasFactory;
    protected $fillable = [
        'attribute_id',
        'value'
    ];
    protected $casts = [
        'attribute_id'   => 'integer',
        'value'          => 'string',
    ];
    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
