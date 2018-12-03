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

    public function create()
    {
    	return view('users.edit_or_create');
    }

    public function store()
    {
    	$rules = [
			'name' => 'required|string',
			'email' => 'required|email',
			'password' => 'required|confirmed|min:5',
			'role_id' => 'required|integer|exists:roles,id', // @todo Auth->User->isAuthorised(Role)
            'branch_id' => 'required|integer|exists:branches,id'
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

        session()->flash('alert-success', 'Uživatel byl úspěšně vytvořen');

    	return redirect()->route('users.index');
    }

    public function login(User $user)
    {
    	Auth::login($user);
    	
    	return redirect()->route('home');
    }

    public function edit(User $user)
    {
    	return view('users.edit_or_create', compact('user'));
    }

    public function update(User $user)
    {
        $rules = [
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'nullable|confirmed|min:5',
            'role_id' => 'required|integer|exists:roles,id', // @todo Auth->User->isAuthorised(Role)
            'branch_id' => 'required|integer|exists:branches,id'
        ];

        $this->validate(request(), $rules);

        unset($rules['password']);
        $user->update(request()->only(array_keys($rules)));

        if(!is_null(request()->input('password')))
            $user->update(['password' => Hash::make(request()->input('password'))]);

        session()->flash('alert-success', 'Uživatel byl úspěšně aktualizován');

        return redirect()->route('users.index');
    }
}
