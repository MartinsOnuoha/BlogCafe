<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'body', 'user_id'];

    public function author()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function post_images()
    {
        return $this->hasMany('App\Models\PostImage');
    }
}
