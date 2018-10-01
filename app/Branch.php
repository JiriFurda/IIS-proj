<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    // --- Laravel settings ---
	public $timestamps = false;
	

    // --- Eloquent relationships ---
    public function medicines()
    {
        return $this->belongsToMany(Medicine::class)->withPivot('amount');;
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }


    // --- Scopes ---
    public function scopeExceptCurrent($query)
    {
        return $query->where('id', '<>', Branch::current()->id);
    }


    // --- Getters ---
    public function nameLink()
    {
    	return '<a href="'.route('branches.show', $this).'" title="Detail pobočky">'.$this->name.'</a>';
    }

    public function getQuantityInStock(Medicine $medicine)
    {
        if($medicineInBranch = $this->medicines->find($medicine))
            return $medicineInBranch->pivot->amount;
        return 0;
    }


    // --- Relationship constructors ---
    public function addSale($requestData = [])
    {
        return $this->sales()->create($requestData);
    }


    // --- Static methods ---
    public static function current()
    {
        return Branch::first(); // @todo dummy result
    }
}
