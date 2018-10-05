<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\KeyIsID;
use App\Rules\KeyUnique;
use App\Medicine;

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

    	/*
    	Review::create([
            'rating' => request('rating'),
            'body' => request('body'),
            'user_id' => auth()->id(),
            'product_id' => $product->id
        ]);
        */
    }
}
