<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $guarded = [];

    public function products() 
    {
      	return $this->belongsToMany('App\Product')->withPivot('id', 'quantity', 'price', 'returned', 'remarks');
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
          $total += ($product->pivot->quantity - $product->pivot->returned) * $product->pivot->price;
        }

        return $total;
    }

    public function getTotalAfterDiscount()
    {
      $total = $this->totalProductPrice();

      if($total != 0 && isset($this->discount)) {
        if($this->discount->amount) {
          $total = $total - $this->discount->amount;
        }

        $total = $total - ($total * $this->discount->percentage)/100;
      }

      return $total;
    }

    public function totalSaleAfterDelivery()
    {
      return $this->totalProductPrice() + $this->deliveryCompany->rate;
    }

    public function totalSaleAfterDeliveryAndDiscount()
    {
      return $this->getTotalAfterDiscount() + $this->deliveryCompany->rate;
    }

    public static function salesOnDay($day)
    {
      return static::whereDate('date', $day)->get()->count();
    }

    public static function increaseInSale()
    {
      $today = static::salesOnDay(Carbon::today());
      $yesterday = static::salesOnDay(Carbon::yesterday());

      return $yesterday ? (($today - $yesterday) / $yesterday) * 100 : 0;
    }



}
