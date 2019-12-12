<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryCompany extends Model
{
    protected $guarded = [];

    public function districtAndZone()
    {
    	return $this->belongsTo('App\DistrictAndZone');
    }
}
