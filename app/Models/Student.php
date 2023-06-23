<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';

    protected $fillable = ['name', 'grade', 'department','image'];

    public function scopeWithCache($query)
{
    $query->cache(60);

    return $query;
}

}
