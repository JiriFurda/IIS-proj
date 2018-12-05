<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    // --- Laravel settings ---
	public $timestamps = false;


    // --- Eloquent relationships ---
    public function branches()
    {
        return $this->belongsToMany(Branch::class)->withPivot('amount');
    }

    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class)->withPivot('price');
    }

    public function insuranceCompanies()
    {
        return $this->belongsToMany(InsuranceCompany::class)->withPivot('amount');
    }

    /*
    public function sales()
    {
        return $this->belongsToMany(Sale::class)->withPivot('quantity', 'price_per_item');
    }
    */



    // --- Getters ---
    public function nameLink()
    {
        return '<a href="'.route('medicines.show', $this).'" title="Detail léku">'.$this->name.'</a>';
    }



    // --- Accessors ---
    public function getOverallPriceAttribute()
    {
        if(is_null($this->pivot))
            abort(500, 'Medicine::getOverallPriceAttribute(): Model is missing a pivot');

        return $this->pivot->price_per_item * $this->pivot->quantity;
    }


    // --- Class methods ---
    public function increaseAmountInBranch(Branch $branch, $addAmount)
    {
 		// Check input parameter
    	if(!is_int($addAmount))
    		abort(500, 'Medicine::increaseAmountInBranch(): Value is not an integer');
 
    	// Search if pivot exists
    	$existingRecord = $this->branches()->find($branch->id);

    	// Calculate amount after change
    	if(is_null($existingRecord))
    		$newAmount = $addAmount;
    	else
    	{
    		$newAmount = $existingRecord->pivot->amount + $addAmount;
    	}

    	// Set new amount
    	$this->setAmountInBranch($branch, $newAmount);
    }

    public function decreaseAmountInBranch(Branch $branch, $subAmount)
    {
    	$this->increaseAmountInBranch($branch, -$subAmount);
    }

    // @todo Check if new value is out of range
    private function setAmountInBranch(Branch $branch, $newAmount)
    {
    	if(!is_int($newAmount))
    		abort(500, 'setAmountInBranch(): Value is not an integer');

    	$this->branches()->syncWithoutDetaching([$branch->id => ['amount' => $newAmount]]);
    }
}
