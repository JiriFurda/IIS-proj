<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SoldMedicine extends Model
{
	// --- Laravel settings ---
	public $timestamps = false;
    protected $fillable = ['medicine_id', 'name', 'price', 'quantity'];


    // --- Eloquent relationships ---
    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function nameLink()
    {
    	return '<a href="'.route('medicines.show', $this->medicine_id).'" title="Detail léku">'.$this->name.'</a>';
    }


    // --- Getters ---
    public function getOverallPriceAttribute()
	{
		return $this->price * $this->quantity;
	}
}
