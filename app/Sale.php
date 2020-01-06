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

    public function voucher() 
    {
      	return $this->belongsTo('App\Voucher');
    }

    public function discount() 
    {
      	return $this->belongsTo('App\Discount');
    }

    public function totalProductPrice() 
    {
        $total = 0;

        foreach ($this->products as $key => $product) {
          $total += $product->pivot->quantity * $product->pivot->price;
        }

        return $total;
    }

    public function getTotalAfterDiscount()
    {
      $total = $this->totalProductPrice();

      if($this->discount->amount) {
        $total = $total - $this->discount->amount;
      }

      $total = $total - ($total * $this->discount->percentage)/100;

      return $total;
    }

}
