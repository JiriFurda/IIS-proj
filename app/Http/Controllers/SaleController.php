<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\Cart;
use App\Branch;
use App\Sale;

class SaleController extends Controller
{
    public function show(Sale $sale)
    {
    	return view('sales.show', compact('sale'));
    }

    public function store()
    {
    	$branch = Branch::current();

    	if(Cart::isEmpty())
    	{
    		session()->flash('error', 'S prázným košíkem nelze vytvořit objednávku.');
    		return back();
    	}

    	// @todo maybe lock branch_medicine table?

    	if(!Cart::verifyStock())
    	{
    		session()->flash('error', 'Na skladě není dostatek léků pro vytvoření objednávky.');
    		return back();
    	}

    	$sale = $branch->addSale();

    	foreach(Cart::items() as $cartItem)
    	{
    		$sale->addSoldMedicine([
    			'medicine_id' => $cartItem->medicine->id,
    			'name' => $cartItem->medicine->name,
    			'price' => $cartItem->medicine->price,
    			'quantity' => $cartItem->quantity
    		]);

    		$cartItem->medicine->decreaseAmountInBranch($branch, $cartItem->quantity);
    	}

    	Cart::earse();

    	return redirect()->route('sale.show', $sale);
    }
}
