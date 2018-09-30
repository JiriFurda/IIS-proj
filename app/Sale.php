<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    public function branch()
    {
        return $this->belongsToOne(Branch::class);
    }


    public function soldMedicines()
    {
        return $this->hasMany(SoldMedicine::class);
    }

    public function addSoldMedicine($requestData)
    {
        return $this->soldMedicines()->create($requestData);
    }


    public function getStateAttribute()
    {
        return ($this->confirmed ? 'Potvrzeno' : 'Nepotvrzeno');
    }
}
