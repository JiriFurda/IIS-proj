<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InsuranceComapnyController extends Controller
{
    public function index()
    {
    	return view('insurance_companies.index');
    }

    public function show(InsuranceCompany $insuranceCompany)
    {
    	return view('insurance_companies.show', compact('insuranceCompany'));
    }
}
