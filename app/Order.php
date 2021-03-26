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
        'date',
        'time'
    ];

    // DB relationships
    public function plates() {
        return $this->belongsToMany('App\Plate', 'order_plate')->withPivot('quantity');// aggiunge la colonna quantity della tabella ponte
    }


}
