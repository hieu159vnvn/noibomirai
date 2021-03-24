<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostTag extends Model
{
    protected $table = 'post_tags';

    public function posts()
    {
        return $this->belongsToMany('App\Models\Post');
    }
}
