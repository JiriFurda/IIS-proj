<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Medicine;
use App\Classes\Cart;

class CartController extends Controller
{
    public function store(Medicine $medicine)
    {
        $this->validate(request(), [
            'quantity' => 'required|integer|min:1'
        ]);

    	Cart::add($medicine, request('quantity'));

    	return back();
    }

    public function update(Medicine $medicine)
    {
		$this->validate(request(), 
		[
		    'medicines'    => 'required|array|min:1',
		    'medicines.*.quantity'  => 'required|integer|min:1',
		    'medicines.*.id'  => 'required|integer|distinct|exists:medicines,id'
		]);

		foreach(request()->input('medicines.*') as $requestItem)
		{
			Cart::update($requestItem['id'], $requestItem['quantity']);
		}

		return back();
    }

    public function delete(Medicine $medicine)
    {
    	Cart::remove($medicine);

		return back();
    }
}
