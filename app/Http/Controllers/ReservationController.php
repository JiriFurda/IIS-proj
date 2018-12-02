<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\KeyIsID;
use App\Rules\KeyUnique;
use App\Medicine;
use App\Reservation;
use App\Branch;

class ReservationController extends Controller
{
    public function create()
    {
    	return view('reservations.create');
    }

    public function store()
    {
    	$this->validate(request(), 
		[
			'customer_name' => 'required',
			'branch_id' => 'required,exists:branches,id',
		    'medicines_quantity.*'  => 'required|integer|min:0',
		    'medicines_quantity'  => [
		    	'required',
		    	'array',
		    	'min:0',
		    	new KeyIsID(Medicine::class),
		    	new KeyUnique
		    ]
		]);
    	
    	$reservation = Reservation::create([
            'customer_name' => request('customer_name'),
            'branch_id' => Branch::current()->id,
            'user_id' => auth()->id(),
        ]);

        foreach(request()->input('medicines_quantity') as $medicineId => $medicineQuantity)
        {
            if($medicineQuantity == 0)
                continue;

            $reservation->medicines()->attach($medicineId, ['quantity_reserved' => $medicineQuantity]);
        }

        session()->flash('alert-success', "Rezervace byla úspěšně vytvořena");

        return redirect()->route('reservations.index');       
    }
}
