<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryCompany extends Model
{
    protected $guarded = [];

    public function companyName()
    {
    	return $this->belongsTo('App\CompanyName');
    }

    public function district()
    {
    	return $this->belongsTo('App\District');
    }
}
