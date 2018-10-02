<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\Cart;
use App\Branch;
use App\Sale;
use Carbon\Carbon;

class SaleController extends Controller
{
    public function index()
    {
        return view('sales.index');
    }


    public function show(Sale $sale)
    {
    	return view('sales.show', compact('sale'));
    }

    public function store()
    {
    	$branch = Branch::current();

    	if(Cart::isEmpty())
    	{
    		session()->flash('error', 'S prázným košíkem nelze vytvořit prodej.');
    		return back();
    	}

    	// @todo maybe lock branch_medicine table?

    	if(!Cart::verifyStock())
    	{
    		session()->flash('error', 'Na skladě není dostatek léků pro vytvoření prodeje.');
    		return back();
    	}

    	$sale = $branch->addSale(['user_id' => auth()->user()->id]);

    	foreach(Cart::items() as $cartItem)
    	{           
            $sale->medicines()->attach($cartItem->medicine->id,
                [
                    'quantity' => $cartItem->quantity,
                    'price_per_item' => $cartItem->medicine->price
                ]);

    		$cartItem->medicine->decreaseAmountInBranch($branch, $cartItem->quantity);

            // @todo Critical part! Throw + catch and revert whole sale if something goes wrong
            // Or save it after everything is done? :O
    	}

    	Cart::earse();

    	return redirect()->route('sales.show', $sale);
    }

    public function confirm(Sale $sale)
    {
        if($sale->confirmed)
        {
            session()->flash('error', 'Prodej je již potvrzen.');
            return back();
        }

        if($sale->user_id != auth()->user()->id)
        {
            session()->flash('error', 'Prodej může potvrdit pouze uživatel, který daný prodej vytvořil.');
            return back();
        }

        $sale->confirmed = 1; // @todo Why doesn't $sale->update() work?
        $sale->confirmed_at = Carbon::now();
        $sale->save();

        session()->flash('success', 'Prodej byl úspěšně potvrzen.');
        return redirect()->route('sales.show', $sale);
    }
}
