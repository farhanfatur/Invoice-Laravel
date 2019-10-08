<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
	use SoftDeletes;
    protected $guarded = [];

    public function product()
    {
    	return $this->belongsToMany("App\Product")->withPivot("dateofissue", "dateofentry", "total_price", "status");
    }

    public function user(){
    	return $this->belongsTo("App\User");
    }
}
