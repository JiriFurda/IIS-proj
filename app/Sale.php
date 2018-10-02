<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    // --- Laravel settings ---
    protected $fillable = ['user_id'];


	// --- Eloquent relationships ---
    public function branch()
    {
        return $this->belongsToOne(Branch::class);
    }

    public function medicines()
    {
        return $this->belongsToMany(Medicine::class)->withPivot('quantity', 'price_per_item');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
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


    // --- Relationship constructors ---
    public function addSoldMedicine($requestData)
    {
        return $this->soldMedicines()->create($requestData);
    }
}
