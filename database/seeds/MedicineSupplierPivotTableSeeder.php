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
    	
    	Supplier::find(1)->medicines()->attach(1, ['price' => 20]);
    	Supplier::find(1)->medicines()->attach(2, ['price' => 123]);
    	Supplier::find(1)->medicines()->attach(3, ['price' => 42]);

    	Supplier::find(2)->medicines()->attach(2, ['price' => 1]);
    }
}
