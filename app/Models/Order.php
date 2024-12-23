<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function order_detail(){
        return $this->hasOne('App\Models\Order_detail','id','order_id');
    }
    public function product(){
        return $this->hasOne('App\Models\Product','id','product_id');
    }
}
