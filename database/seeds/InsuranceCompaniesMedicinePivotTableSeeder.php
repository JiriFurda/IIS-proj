<?php

use Illuminate\Database\Seeder;
use App\Medicine;
use App\InsuranceCompany;

class InsuranceCompaniesMedicinePivotTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $medicine = Medicine::where('prescription', true)->first();

        $medicine->insuranceCompanies()->attach(1, ['amount' => 10]);
        $medicine->insuranceCompanies()->attach(2, ['amount' => 15]);
        $medicine->insuranceCompanies()->attach(3, ['amount' => 20]);

        $medicine->insuranceCompanies()->attach(4, ['amount' => 11]);
        $medicine->insuranceCompanies()->attach(5, ['amount' => 7]);
        $medicine->insuranceCompanies()->attach(6, ['amount' => 5]);
    }
}
