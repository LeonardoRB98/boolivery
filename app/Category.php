<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{   // commento
    protected $fillable = [
        'category'
    ];
    // DB relationships references restaurants
    public function restaurants() {
        return $this->belongsToMany('App\Restaurant', 'category_restaurant');
    }
}
