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
    public function addSale($saleData, $cartItems, $virtual = false)
    {
        if(!$virtual)
        {
            foreach ($cartItems as $cartItem) {
                if (!$cartItem->verifyStock())
                    return null;
            }
        }

        $sale = $this->sales()->create($saleData);

        foreach($cartItems as $cartItem)
        {
            if($cartItem->medicine->prescription)
            {
                if($insuranceCompany = $cartItem->medicine->insuranceCompanies->find($sale->insuranceCompany))
                    $contribution = $insuranceCompany->pivot->amount;
                else
                    $contribution = 0;
            }
            else
                $contribution = null;


            $sale->medicines()->attach($cartItem->medicine->id,
                [
                    'insurance_contribution_per_item' => $contribution,
                    'quantity' => $cartItem->quantity,
                    'price_per_item' => $cartItem->medicine->price
                ]);

            if(!$virtual)
                $cartItem->medicine->decreaseAmountInBranch($sale->branch, $cartItem->quantity);
        }

        return $sale;
    }


    public function addSupply($data)
    {
        $medicines = $this->medicines;
        foreach($data as $medicineId => $addedAmount)
        {
            if(!$addedAmount)
                continue;

            if($this->medicines->find($medicineId))
            {
                $pivot = $this->medicines->find($medicineId)->pivot;
                $pivot->update(['amount' => $pivot->amount + $addedAmount]);
            }
            else
                $this->medicines()->attach($medicineId, ['amount' => $addedAmount]);
        }
    }


    // --- Static methods ---
    public static function current()
    {
        if(auth()->user() && ($branch = auth()->user()->branch))
            return $branch;

        return Branch::first();
    }
}
