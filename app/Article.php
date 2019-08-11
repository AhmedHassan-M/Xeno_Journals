<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User' , 'author_id');
    }

    public function author()
    {
        return $this->hasMany('App\Author');
    }

    public function journal()
    {
        return $this->belongsTo('App\Journal');
    }

    public function activity()
    {
        return $this->hasMany('App\Activity');
    }
}
