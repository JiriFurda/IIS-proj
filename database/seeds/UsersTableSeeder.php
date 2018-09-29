<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
    	if(config('auth.first_user.enabled'))
    	{
	    	User::create([
				'name' => config('auth.first_user.name'),
				'email' => config('auth.first_user.email'),
				'password' => Hash::make(config('auth.first_user.password')),
				'remember_token' => str_random(10)
	    	]);
    	}
    }
}
