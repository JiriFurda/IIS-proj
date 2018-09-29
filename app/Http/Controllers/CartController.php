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
}
