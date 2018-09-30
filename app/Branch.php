<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
	public $timestamps = false;
	
    public function medicines()
    {
        return $this->belongsToMany(Medicine::class)->withPivot('amount');;
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function nameLink()
    {
    	return '<a href="'.route('branches.show', $this).'" title="Detail pobočky">'.$this->name.'</a>';
    }

    public static function current()
    {
        return Branch::first(); // @todo dummy result
    }


    public function scopeExceptCurrent($query)
    {
        return $query->where('id', '<>', Branch::current()->id);
    }

    public function getQuantityInStock(Medicine $medicine)
    {
        if($medicineInBranch = $this->medicines->find($medicine))
            return $medicineInBranch->pivot->amount;
        return 0;
    }

    public function addSale($requestData = [])
    {
        return $this->sales()->create($requestData);
    }
}
