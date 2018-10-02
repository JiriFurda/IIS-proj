<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
	// --- Eloquent relationships ---
    public function branch()
    {
        return $this->belongsToOne(Branch::class);
    }

    public function medicines()
    {
        return $this->belongsToMany(Medicine::class)->withPivot('quantity', 'price_per_item');
    }


    // --- Getters ---
    public function getStateAttribute()
    {
        return ($this->confirmed ? 'Potvrzeno' : 'Nepotvrzeno');
    }


    // --- Relationship constructors ---
    public function addSoldMedicine($requestData)
    {
        return $this->soldMedicines()->create($requestData);
    }
}
