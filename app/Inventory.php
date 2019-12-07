<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $guarded = [];

    public function product()
    {
    	return $this->belongsTo('App\Product');
    }

    public static function addToInventory($data)
    {
    	$quantity = $data['quantity'];
    	$inventory = static::where('product_id', $data['product_id'])->first();

    	if(!empty($inventory)) {
    		$quantity += $inventory->quantity;
    		static::find($inventory->id)->update([
	    		'quantity' => $quantity,
	    		'mrp' => $data['mrp'],
	    	]);
    	} else {
    		static::create($data);
    	}
    }
}
