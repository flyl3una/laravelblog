<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag')->withTimestamps();
    }


}
