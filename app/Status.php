<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
	protected $guarded = [];
    public function user()
    {
    	return $this->belongsTo("App\User");
    }

    public function admin()
    {
    	return $this->belongsTo("App\Admin");
    }
}
