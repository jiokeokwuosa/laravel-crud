<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rest extends Model
{
    public function articles()
    {
        return $this->hasMany('App\Article')->orderBy('id', 'DESC');
    }
}
