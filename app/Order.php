<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'email',
        'restaurant_id',
        'indirizzo',
        'status',
        'date'
    ];

    // DB relationships
    public function orders() {
    return $this->belongsToMany('App\Order', 'order_plate');
    }

    public function restaurant() {
        return $this->belongsTo('App\Restaurant');
        }
}
