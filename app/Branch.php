<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
	public $timestamps = false;
	
    public function medicines()
    {
        return $this->belongsToMany('App\Medicine')->withPivot('amount');;
    }
}
