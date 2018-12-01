<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    // --- Laravel settings ---
    protected $guarded = ['id'];


	// --- Eloquent relationships ---
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function medicines()
    {
        return $this->belongsToMany(Medicine::class)->withPivot('quantity', 'price_per_item', 'insurance_contribution_per_item');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function insuranceCompany()
    {
        return $this->belongsTo(InsuranceCompany::class);
    }


    // --- Getters ---
    public function nameLink()
    {
        return '<a href="'.route('sales.show', $this).'" title="Detail prodeje">Prodej '.$this->name.'</a>';
    }


    // --- Accessors ---
    public function getStateAttribute()
    {
        return ($this->confirmed ? 'Potvrzeno' : 'Nepotvrzeno');
    }

    public function getNameAttribute()
    {
        return '#'.$this->id;
    }

    public function getOverallPriceAttribute()
    {
        $sum = 0;
        foreach($this->medicines as $medicine)
        {
            $sum += $medicine->pivot->price_per_item * $medicine->pivot->quantity;
        }

        return $sum;
    }

    public function getOverallCustomerPriceAttribute()
    {
        if(!$this->prescripted)
            return $this->overall_price;

        $sum = 0;
        foreach($this->medicines as $medicine)
        {
            $contribution = $medicine->pivot->insurance_contribution_per_item;
            $contribution = ($contribution ? $contribution : 0);
            $sum += ($medicine->pivot->price_per_item - $contribution) * $medicine->pivot->quantity;
        }

        return $sum;
    }

    public function getPrescriptedAttribute()
    {
        return $this->customer_nin && $this->insuranceCompany;
    }


    // --- Relationship constructors ---
    public function addSoldMedicine($requestData)
    {
        return $this->soldMedicines()->create($requestData);
    }
}
