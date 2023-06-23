<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Customer extends Model{

    protected $casts = [
        'customerNumber ' => 'integer'
    ];
    protected $primaryKey = 'customerNumber';

    public function order()
    {
        return $this->belongsTo(Order::class, 'customerNumber');
    }
  
}
  