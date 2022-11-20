<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['user_id', 'blog_id', 'comment'];
    
    public function user() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    public function blog() {
        return $this->belongsTo('App\Blog', 'blog_id', 'id');
    }
}
