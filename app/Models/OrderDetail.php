<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class OrderDetail extends Model{
    protected $table = 'orderdetails';
    protected $primaryKey = 'orderNumber';
    
}
  