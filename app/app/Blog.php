<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = ['user_id', 'date', 'text', 'img'];
    
    public function user() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
