<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Supplier;
use App\Medicine;

class MedicineSupplierPivotTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(Supplier::all() as $supplier)
        {
            foreach(Medicine::all() as $medicine)
            {
                $supplier->medicines()->attach($medicine->id, ['price' => mt_rand(0,$medicine->price)]);
            }
        }
    }
}
