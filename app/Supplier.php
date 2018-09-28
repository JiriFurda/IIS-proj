<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
	public $timestamps = false;
	
    public function medicines()
    {
        return $this->belongsToMany(Medicine::class)->withPivot('price');;
    }

    public function nameLink()
    {
    	return '<a href="'.route('suppliers.show', $this).'" title="Detail dodavatelel">'.$this->name.'</a>';
    }
}
