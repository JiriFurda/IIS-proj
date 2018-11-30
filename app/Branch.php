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
    public function addSale($saleData = [], $cartItems)
    {
        $sale = $this->sales()->create($saleData);

        foreach($cartItems as $cartItem)
        {
            $sale->medicines()->attach($cartItem->medicine->id,
                [
                    'quantity' => $cartItem->quantity,
                    'price_per_item' => $cartItem->medicine->price
                ]);

            $cartItem->medicine->decreaseAmountInBranch($sale->branch, $cartItem->quantity);

            // @todo Critical part! Throw + catch and revert whole sale if something goes wrong
            // Or save it after everything is done? :O
        }

        return $sale;
    }


    // --- Static methods ---
    public static function current()
    {
        return Branch::first(); // @todo dummy result
    }
}
