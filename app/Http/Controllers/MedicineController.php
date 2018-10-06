<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Medicine;

class MedicineController extends Controller
{
    public function index()
    {
    	return view('medicines.index');
    }

    public function show(Medicine $medicine)
    {
    	return view('medicines.show', compact('medicine'));
    }

    public function edit(Medicine $medicine)
    {
    	return view('medicines.edit_or_create', compact('medicine'));
    }


    public function update(Medicine $medicine)
    {
    	$rules = [
			'name' => 'required|string',
			'price' => 'required|numeric|between:0.00,99999.99',
			'prescription' => 'required|boolean'
		];

    	$this->validate(request(), $rules); 

    	$properties = array_keys($rules);
    	foreach(array_intersect_key(request()->input(), array_flip($properties)) as $property => $value)
    	{
    		$medicine->$property = $value;
    	}

    	$medicine->save();

    	session()->flash('alert-success', "Údaje léku {$medicine->name} byly úspěšně změněny");

    	return redirect()->route('medicines.show', compact('medicine'));
    }

}
