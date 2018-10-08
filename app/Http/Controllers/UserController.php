<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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
    	//dd('@todo');

    	$rules = [
			'name' => 'required|string',
			'email' => 'required|email',
			'password' => 'required|confirmed|min:5',
			'role_id' => 'required|integer|exists:roles,id' // @todo Auth->User->isAuthorised(Role)
		];

    	$this->validate(request(), $rules); 


    	$user = new User;

    	unset($rules['password']);
    	$properties = array_keys($rules);
    	foreach(array_intersect_key(request()->input(), array_flip($properties)) as $property => $value)
    	{
    		$user->$property = $value;
    	}

    	$user->password = Hash::make(request()->input('password'));
		$user->remember_token = str_random(10);
		$user->save();

    	return redirect()->route('users.index');
    }

    public function login(User $user)
    {
    	Auth::login($user);
    	
    	return redirect()->route('home');
    }

    public function edit(User $user)
    {
    	dd('@todo');
    }
}
