<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    public function category()
    {
        return $this->belongsTo('App\Models\PostCategory');
    }
    public function tags()
    {
        return $this->belongsToMany('App\Models\PostTag','post_tag','post_id','tag_id');
    }
}
