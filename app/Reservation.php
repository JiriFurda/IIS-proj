<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    // --- Laravel settings ---
	public $timestamps = false;

    // --- Eloquent relationships ---
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function medicines()
    {
        return $this->belongsToMany(Supplier::class)->withPivot('quantity');
    }

}
