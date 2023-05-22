<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'merk',
        'jenis',
    ];

    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction', 'product_id', 'id');
    }

    public function stocks()
    {
        return $this->hasMany('App\Models\Stock', 'product_id', 'id');
    }
}
