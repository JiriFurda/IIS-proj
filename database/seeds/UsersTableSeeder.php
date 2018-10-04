<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
    	if(config('auth.first_user.enabled'))
    	{
	    	User::create([
	    		'role_id' => Role::where('internal_name', 'admin')->first()->id,
				'name' => config('auth.first_user.name'),
				'email' => config('auth.first_user.email'),
				'password' => Hash::make(config('auth.first_user.password')),
				'remember_token' => str_random(10)
	    	]);
    	}
    }
}
