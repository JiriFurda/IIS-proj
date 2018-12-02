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

    public function store($presriptionValiadated = false)
    {
    	if(Cart::isEmpty())
    	{
    		session()->flash('alert-danger', 'S prázným košíkem nelze vytvořit prodej.');
    		return back();
    	}

    	// @todo maybe lock branch_medicine table?

    	if(!Cart::verifyStock())
    	{
    		session()->flash('alert-danger', 'Na skladě není dostatek léků pro vytvoření prodeje. Chcete vytvořit <a class="alert-link" href="'.route('reservations.create').'">rezervaci?</a>');
    		return back();
    	}

    	if(Cart::hasPrescriptedMedicine())
        {
            if(!$presriptionValiadated)
                return redirect()->route('sales.create_prescripted');

            $sale = Branch::current()->addSale([
                'user_id' => auth()->user()->id,
                'customer_nin' => request()->input('customer_nin'),
                'insurance_company_id' => request()->input('insurance_company_id'),
                ], Cart::items());
        }
        else
    	    $sale = Branch::current()->addSale(['user_id' => auth()->user()->id], Cart::items());

    	Cart::erase();

    	return redirect()->route('sales.show', $sale);
    }

    public function createPrescripted()
    {
        return view('sales.create_prescripted');
    }

    public function storePrescripted()
    {
        $this->validate(request(),
            [
                'customer_nin' => 'required',   // @todo regex check
                'insurance_company_id' => 'required|exists:insurance_companies,id',
            ]);

        return self::store(true);
    }

    public function confirm(Sale $sale)
    {
        if($sale->confirmed)
        {
            session()->flash('alert-danger', 'Prodej je již potvrzen.');
            return back();
        }

        if($sale->user_id != auth()->user()->id)
        {
            session()->flash('alert-danger', 'Prodej může potvrdit pouze uživatel, který daný prodej vytvořil.');
            return back();
        }

        $sale->confirmed = 1; // @todo Why doesn't $sale->update() work?
        $sale->confirmed_at = Carbon::now();
        $sale->save();

        session()->flash('success', 'Prodej byl úspěšně potvrzen.');
        return redirect()->route('sales.show', $sale);
    }
}
