<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;

class SupplierController extends Controller
{
    public function index()
    {
    	return view('suppliers.index');
    }

    public function show(Supplier $supplier)
    {
    	return view('suppliers.show', compact('supplier'));
    }
}
