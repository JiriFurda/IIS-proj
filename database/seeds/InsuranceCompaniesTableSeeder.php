<?php

use Illuminate\Database\Seeder;
use App\InsuranceCompany;

class InsuranceCompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InsuranceCompany::create([
            'name' => 'Union',
            'code' => 554,
        ]);

        InsuranceCompany::create([
            'name' => 'ČSOB',
            'code' => 499,
        ]);

        InsuranceCompany::create([
            'name' => 'VZP',
            'code' => 888,
        ]);
    }
}
