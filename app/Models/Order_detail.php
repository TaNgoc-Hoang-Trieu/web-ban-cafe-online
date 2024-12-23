<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    public function product(){
        return $this->hasOne('App\Models\Product','id','product_id');
    }
    public function order(){
        return $this->hasOne('App\Models\Order','id','order_id');
    }
}
