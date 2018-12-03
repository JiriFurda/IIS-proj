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


        InsuranceCompany::create([
            'name' => 'MAXIMA',
            'code' => 399,
        ]);


        InsuranceCompany::create([
            'name' => 'ERV',
            'code' => 666,
        ]);


        InsuranceCompany::create([
            'name' => 'AXA',
            'code' => 522,
        ]);
    }
}
