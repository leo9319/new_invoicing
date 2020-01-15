<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function brand()
    {
    	return $this->belongsTo('App\Brand');
    }

    public function inventory()
    {
        return $this->hasOne('App\Inventory');
    }

    public function sales()
    {
    	return $this->belongsToMany('App\Sale');
    }

    public function voucher()
    {
    	return $this->hasOne('App\Voucher');
    }

    public function addToInventory($quantity)
    {
        $count = $this->inventory->quantity;

        $count += $quantity;

        $this->inventory->quantity = $count;

        $this->push();
    }

    public function removeFromInventory($quantity)
    {
        $count = $this->inventory->quantity;

        $count -= $quantity;

        $this->inventory->quantity = $count;

        $this->push();
    }
}
