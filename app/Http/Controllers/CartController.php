<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Medicine;
use App\Classes\Cart;

class CartController extends Controller
{
    public function index()
    {
		return view('cart.index');
    }

    /**
     * Method for adding medicines into the shopping cart
     * @param  Medicine
     * @return [type]
     */
    public function store(Medicine $medicine)
    {
        // Check request values
        $this->validate(request(), [
            'quantity' => 'required|integer|min:1'
        ]);

        // Add medicine into the shopping cart
    	Cart::add($medicine, request('quantity'));

        // Redirect to previous page
    	return back();
    }

    /**
     * Method for updating medicines quantity in the shopping cart
     * @param  Medicine
     * @return [type]
     */
    public function update(Medicine $medicine)
    {
        // Check request values
		$this->validate(request(), 
		[
		    'medicines'    => 'required|array|min:1',
		    'medicines.*.quantity'  => 'required|integer|min:1',
		    'medicines.*.id'  => 'required|integer|distinct|exists:medicines,id'
		]);

        // Update quantity of every medicine in the shopping cart
		foreach(request()->input('medicines.*') as $requestItem)
		{
			Cart::update($requestItem['id'], $requestItem['quantity']);
		}

        // Redirect to previous page
		return back();
    }

    /**
     * Method for discaring all medicines in the shopping cart
     * @param  Medicine
     * @return [type]
     */
    public function delete(Medicine $medicine)
    {
    	Cart::remove($medicine);

		return back();
    }
}
