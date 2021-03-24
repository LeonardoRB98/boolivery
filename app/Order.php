<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'email',
        'name',
        'surname',
        'address',
        'status',
        'total',
        'date'
    ];

    // DB relationships
    public function plates() {
        return $this->belongsToMany('App\Plate', 'order_plate');
    }


}
