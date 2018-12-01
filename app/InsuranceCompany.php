<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InsuranceCompany extends Model
{
    // --- Laravel settings ---
    protected $guarded = ['id'];
    public $timestamps = false;

    // --- Eloquent relationships ---
    public function sales()
    {
        return $this->HasMany(Sale::class);
    }

    public function medicines()
    {
        return $this->belongsToMany(Medicine::class)->withPivot('amount');
    }

	// --- Getters ---
    public function nameLink()
    {
        return $this->name.' ('.$this->code.')';
    	//return '<a href="'.route('insurance_companies.show', $this).'" title="Detail pojišťovny">'.$this->name.' ('.$this->code.')</a>';
    }
}
