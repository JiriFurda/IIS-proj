<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'role_id' => Role::where('internal_name', 'admin')->first()->id,
            'name' => 'Ředitel Ondřej',
            'email' => 'reditel@lekarna.cz',
            'password' => Hash::make('reditel'),
            'remember_token' => str_random(10)
        ]);

        User::create([
            'role_id' => Role::where('internal_name', 'superior')->first()->id,
            'name' => 'Nadřízený František',
            'email' => 'nadrizeny@lekarna.cz',
            'password' => Hash::make('nadrizeny'),
            'remember_token' => str_random(10)
        ]);

        User::create([
            'role_id' => Role::where('internal_name', 'pharmacist')->first()->id,
            'name' => 'Lékárník Peter',
            'email' => 'lekarnik1@lekarna.cz',
            'password' => Hash::make('lekarnik1'),
            'remember_token' => str_random(10),
            'branch_id' => 1,
        ]);

        User::create([
            'role_id' => Role::where('internal_name', 'pharmacist')->first()->id,
            'name' => 'Lékárník Jiří',
            'email' => 'lekarnik2@lekarna.cz',
            'password' => Hash::make('lekarnik2'),
            'remember_token' => str_random(10),
            'branch_id' => 2,
        ]);

        User::create([
            'role_id' => Role::where('internal_name', 'pharmacist')->first()->id,
            'name' => 'Lékárník Michal',
            'email' => 'lekarnik3@lekarna.cz',
            'password' => Hash::make('lekarnik3'),
            'remember_token' => str_random(10),
            'branch_id' => 3,
        ]);

        User::create([
            'role_id' => Role::where('internal_name', 'pharmacist')->first()->id,
            'name' => 'Lékárník Vojta',
            'email' => 'lekarnik4@lekarna.cz',
            'password' => Hash::make('lekarnik4'),
            'remember_token' => str_random(10),
            'branch_id' => 4,
        ]);

        User::create([
            'role_id' => Role::where('internal_name', 'pharmacist')->first()->id,
            'name' => 'Lékárník Adam',
            'email' => 'lekarnik5@lekarna.cz',
            'password' => Hash::make('lekarnik5'),
            'remember_token' => str_random(10),
            'branch_id' => 4,
        ]);
    }
}
