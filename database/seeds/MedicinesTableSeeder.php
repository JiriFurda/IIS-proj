<?php

use Illuminate\Database\Seeder;
use App\Medicine;

class MedicinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		Medicine::create([
			'name' => 'PARADIM',
			'price' => 49,
			'prescription' => false
		]);
		
		Medicine::create([
			'name' => 'PABAL',
			'price' => 88,
			'prescription' => false
		]);
		
		Medicine::create([
			'name' => 'IALUGEN PLUES',
			'price' => 22,
			'prescription' => true
		]);


		Medicine::create([
		    'name' => 'ALVESCO 160',
            'price' => 160,
            'prescription' => true
        ]);

        Medicine::create([
            'name' => 'ZENTIVA ',
            'price' => 330,
            'prescription' => true
        ]);

        Medicine::create([
            'name' => 'OMEPRAZOL',
            'price' => 120,
            'prescription' => true
        ]);

        Medicine::create([
            'name' => ' COAPROVEL',
            'price' => 88,
            'prescription' => false
        ]);

        Medicine::create([
            'name' => 'TRIDEPOS',
            'price' => 120,
            'prescription' => true
        ]);

        Medicine::create([
            'name' => 'AMBROSAN',
            'price' => 33,
            'prescription' => false
        ]);

        Medicine::create([
            'name' => 'ZALASTA ',
            'price' => 25,
            'prescription' => true
        ]);

        Medicine::create([
            'name' => 'TRIASYN',
            'price' => 999,
            'prescription' => true
        ]);
    }
}
