<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyName extends Model
{
    protected $guarded = [];

    public function district()
    {
    	return $this->belongsTo('App\District');
    }
}
