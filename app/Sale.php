<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $guarded = [];

    public function products() 
    {
      	return $this->belongsToMany('App\Product')->withPivot('quantity', 'price');
    }

    public function deliveryCompany() 
    {
      	return $this->belongsTo('App\DeliveryCompany');
    }

}
