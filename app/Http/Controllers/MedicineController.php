<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Medicine;

class MedicineController extends Controller
{
    public function index()
    {
    	return view('medicine.index');
    }

    public function show(Medicine $medicine)
    {
    	return view('medicine.show', compact('medicine'));
    }

}
