<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index()
    {
    	return view('users.index');
    }

    public function show(InsuranceCompany $insuranceCompany)
    {
    	return view('insurance_companies.show', compact('insuranceCompany'));
    }
}
