<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(MedicinesTableSeeder::class);
        $this->call(BranchesTableSeeder::class);
        $this->call(SuppliersTableSeeder::class);
        $this->call(InsuranceCompaniesTableSeeder::class);

        $this->call(BranchMedicinePivotTableSeeder::class);
        $this->call(MedicineSupplierPivotTableSeeder::class);
        $this->call(SalesTableSeeder::class);
    }
}
