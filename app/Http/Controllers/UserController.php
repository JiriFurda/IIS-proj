<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index()
    {
    	$users = User::all();

    	return view('users.index', compact('users'));
    }

/*
    public function show(InsuranceCompany $insuranceCompany)
    {
    	return view('insurance_companies.show', compact('insuranceCompany'));
    }
*/
    public function create()
    {
    	return view('users.create');
    }

    public function store()
    {
    	dd('@todo');
    }
}
