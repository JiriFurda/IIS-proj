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

    /**
     * 1  - 49
     * 2  - 88
     * 3  - 22
     * 4  - 160
     * 5  - 330
     * 6  - 120
     * 7  - 88
     * 8  - 120
     * 9  - 33
     * 10 - 25
     * 11 - 999
     */
    public function run()
    {
    	
    	Supplier::find(1)->medicines()->attach(1, ['price' => 20]);
    	Supplier::find(1)->medicines()->attach(2, ['price' => 66]);
    	Supplier::find(1)->medicines()->attach(3, ['price' => 15]);

    	Supplier::find(2)->medicines()->attach(2, ['price' => 1]);
        Supplier::find(2)->medicines()->attach(11, ['price' => 380]);
        Supplier::find(2)->medicines()->attach(6, ['price' => 20]);
        Supplier::find(2)->medicines()->attach(8, ['price' => 40]);
        Supplier::find(2)->medicines()->attach(10, ['price' => 5]);
        Supplier::find(2)->medicines()->attach(4, ['price' => 35]);

        Supplier::find(3)->medicines()->attach(2, ['price' => 20]);
        Supplier::find(3)->medicines()->attach(3, ['price' => 7]);
        Supplier::find(3)->medicines()->attach(5, ['price' => 190]);
        Supplier::find(3)->medicines()->attach(11, ['price' => 600]);
        Supplier::find(3)->medicines()->attach(10, ['price' => 19]);
        Supplier::find(3)->medicines()->attach(7, ['price' => 49]);

        Supplier::find(4)->medicines()->attach(1, ['price' => 27]);
        Supplier::find(4)->medicines()->attach(2, ['price' => 59]);
        Supplier::find(4)->medicines()->attach(6, ['price' => 99]);
        Supplier::find(4)->medicines()->attach(7, ['price' => 33]);
        Supplier::find(4)->medicines()->attach(8, ['price' => 70]);
        Supplier::find(4)->medicines()->attach(9, ['price' => 16]);
        Supplier::find(4)->medicines()->attach(10, ['price' => 13]);
        Supplier::find(4)->medicines()->attach(11, ['price' => 720]);
        Supplier::find(4)->medicines()->attach(5, ['price' => 100]);

        Supplier::find(5)->medicines()->attach(1, ['price' => 41]);
        Supplier::find(5)->medicines()->attach(2, ['price' => 52]);
        Supplier::find(5)->medicines()->attach(9, ['price' => 28]);
        Supplier::find(5)->medicines()->attach(11, ['price' => 490]);

        Supplier::find(6)->medicines()->attach(1, ['price' => 18]);
        Supplier::find(6)->medicines()->attach(2, ['price' => 21]);
        Supplier::find(6)->medicines()->attach(3, ['price' => 18]);
        Supplier::find(6)->medicines()->attach(5, ['price' => 50]);
        Supplier::find(6)->medicines()->attach(6, ['price' => 95]);
        Supplier::find(6)->medicines()->attach(7, ['price' => 61]);
        Supplier::find(6)->medicines()->attach(8, ['price' => 76]);
        Supplier::find(6)->medicines()->attach(9, ['price' => 30]);
        Supplier::find(6)->medicines()->attach(10, ['price' => 11]);
        Supplier::find(6)->medicines()->attach(11, ['price' => 490]);
    }
}
