<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InsuranceCompany;

class InsuranceComapnyController extends Controller
{
    public function index()
    {
        $insuranceCompanies = InsuranceCompany::all();
    	return view('insurance_companies.index', compact('insuranceCompanies'));
    }

    public function show(InsuranceCompany $insuranceCompany)
    {
    	return view('insurance_companies.show', compact('insuranceCompany'));
    }
}
