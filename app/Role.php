<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    // --- Laravel settings ---
	public $timestamps = false;

    // --- Eloquent relationships ---
    public function ancestor()
    {
        return $this->belongsTo(Role::class, 'inherit_id', 'id');
    }


    // ---
    public function searchInHiearchy($searched)
    {
    	// Check if this Role is the searched one -> search succeed
        if($this->internal_name == $searched)
            return true;

        // Check if this Role has no ancestor -> search failed
        if(is_null($this->inherit_id))
            return false;

        // Continue in search in the ancestor
        return $this->ancestor->searchInHiearchy($searched);
    }
}
