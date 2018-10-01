<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InsuranceCompany extends Model
{
	// --- Getters ---
    public function nameLink()
    {
    	return '<a href="'.route('insutance_companies.show', $this).'" title="Detail pojišťovny">'.$this->name.'</a>';
    }
}
