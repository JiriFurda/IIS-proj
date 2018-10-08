<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    // --- Laravel settings ---
	public $timestamps = false;
    protected $fillable = ['customer_name', 'branch_id', 'user_id'];

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
        return $this->belongsToMany(Medicine::class)->withPivot('quantity_reserved', 'quantity_picked_up');
    }

    // --- Accessors ---
    public function getCompletedAttribute()
    {
        return !is_null($this->completed_at);
    }

}
