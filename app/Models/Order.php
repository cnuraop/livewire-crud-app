<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Order extends Model{

    protected $primaryKey = 'orderNumber';
    public function details()
    {
        return $this->hasMany(OrderDetail::class,'orderNumber');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customerNumber');
    }



}
  