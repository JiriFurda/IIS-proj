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

    public function nameLink()
    {
    	return '<a href="'.route('branches.show', $this).'" title="Detail pobočky">'.$this->name.'</a>';
    }
}
