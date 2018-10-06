<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\KeyIsID;
use App\Rules\KeyUnique;
use App\Medicine;
use App\Reservation;

class ReservationController extends Controller
{
    public function create()
    {
    	return view('reservations.create');
    }

    public function store()
    {
    	//dd(request());

    	$this->validate(request(), 
		[
			'customer_name' => 'required',
			'branch_id' => 'required,exists:branches,id',
		    'medicines_quantity.*'  => 'required|integer|min:0',
		    'medicines_quantity'  => [
		    	'required',
		    	'array',
		    	'min:1',
		    	new KeyIsID(Medicine::class),
		    	new KeyUnique
		    ]
		]);

		dd('valid');

    	
    	$reservation = Reservation::create([
            'customer_name' => request('customer_name'),
            'branch_id' => request('branch_id'),
            'user_id' => auth()->id(),
        ]);

        
    }
}
