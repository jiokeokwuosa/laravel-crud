<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public function rest()
    {
        return $this->belongsTo('App\Rest');
    }
}
