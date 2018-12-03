<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $prevRole = Role::create([
            'internal_name' => 'pharmacist',
            'name' => 'Lékárník'
        ]);

        $prevRole = Role::create([
            'internal_name' => 'superior',
            'name' => 'Nadřízený',
            'inherit_id' => $prevRole->id
        ]);

        Role::create([
            'internal_name' => 'admin',
            'name' => 'Ředitel',
            'inherit_id' => $prevRole->id
        ]);
    }
}
