<?php

use Illuminate\Database\Seeder;
use App\Supplier;

class SuppliersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		Supplier::create([
			'name' => 'Bayer'
		]);
		
		Supplier::create([
			'name' => 'GlaxoSmithKline'
		]);
		
		Supplier::create([
			'name' => 'Lundbeck'
		]);

        Supplier::create([
            'name' => 'Euroclinic'
        ]);

        Supplier::create([
            'name' => 'Dialysis'
        ]);

        Supplier::create([
            'name' => 'Ansell'
        ]);
    }
}
