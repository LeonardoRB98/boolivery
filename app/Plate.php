<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plate extends Model
{
    protected $fillable = [
        'restaurant_id',
        'name',
        'photo',
        'description',
        'price',
    ];

    // DB relationships
    public function plates() {
        return $this->belongsToMany('App\Plate', 'order_plate');
    }

    public function restaurant() {
        return $this->belongsTo('App\Restaurant');
    }
}
