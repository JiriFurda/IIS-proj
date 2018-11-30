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
        $sales = Sale::all();

        return view('sales.index', compact('sales'));
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
    		session()->flash('alert-error', 'S prázným košíkem nelze vytvořit prodej.');
    		return back();
    	}

    	// @todo maybe lock branch_medicine table?

    	if(!Cart::verifyStock())
    	{
    		session()->flash('alert-error', 'Na skladě není dostatek léků pro vytvoření prodeje.');
    		return back();
    	}

    	$sale = $branch->addSale(['user_id' => auth()->user()->id], Cart::items());

    	Cart::earse();

    	return redirect()->route('sales.show', $sale);
    }

    public function confirm(Sale $sale)
    {
        if($sale->confirmed)
        {
            session()->flash('alert-error', 'Prodej je již potvrzen.');
            return back();
        }

        if($sale->user_id != auth()->user()->id)
        {
            session()->flash('alert-error', 'Prodej může potvrdit pouze uživatel, který daný prodej vytvořil.');
            return back();
        }

        $sale->confirmed = 1; // @todo Why doesn't $sale->update() work?
        $sale->confirmed_at = Carbon::now();
        $sale->save();

        session()->flash('success', 'Prodej byl úspěšně potvrzen.');
        return redirect()->route('sales.show', $sale);
    }
}
