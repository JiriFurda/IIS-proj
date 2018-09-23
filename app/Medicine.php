<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
	public $timestamps = false;

    public function branches()
    {
        return $this->belongsToMany('App\Branch')->withPivot('amount');;
    }



    public function increaseAmountInBranch(Branch $branch, $addAmount)
    {
 		// Check input parameter
    	if(!is_int($newAmount))
    		abort(500, 'increaseAmountInBranch(): Value is not an integer');
 
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
