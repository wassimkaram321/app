<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    use HasFactory;
    protected $fillable =[
        'name'
    ];
    protected $casts = [
        'name'   => 'string',
    ];
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
