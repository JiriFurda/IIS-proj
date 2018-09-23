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
    }
}
