<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_images';

    public function category()
    {
        return $this->belongsTo('App\Models\Product','product_id','id');
    }
}
