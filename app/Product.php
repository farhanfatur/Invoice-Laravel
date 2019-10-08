<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function customer()
    {
    	return $this->belongsToMany("App\Customer")->withPivot("dateofissue", "dateofentry", "total_price", "status");
    }
}
