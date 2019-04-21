<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booktype extends Model
{
    protected $table = 'booktype';

    public function products() {
        return $this->hasMany('App\Books');
    }
}
