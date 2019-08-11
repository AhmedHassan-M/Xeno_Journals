<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = ['name' , 'title' , 'affiliation'];

    public function article()
    {
        return $this->belongsTo('App\Article');
    }
}
