<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    public function category()
    {
        return $this->belongsTo('App\Models\ProductCategory','product_category_id','id');
    }
    public function tags()
    {
        return $this->belongsToMany('App\Models\ProductTag','product_tag','product_id','tag_id');
    }
    public function images()
    {
        return $this->hasMany('App\Models\ProductImage','product_id','id');
    }
}
