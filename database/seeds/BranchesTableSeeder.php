<?php

use Illuminate\Database\Seeder;
use App\Branch;

class BranchesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		Branch::create([
			'name' => 'The pharmacy market',
			'address' => 'Gorkeho 22, 602 00 Brno-stred, Cesko'
		]);
		
		Branch::create([
			'name' => 'Pharmacy Aesculap',
			'address' => 'Dornych 404/4, 602 00 Brno, Cesko'
		]);

        Branch::create([
            'name' => 'APOTEX (ČR), spol. s r. o.',
            'address' => 'Salvátorská 10, 116 22 Praha 1, Cesko'
        ]);

        Branch::create([
            'name' => 'ICN Czech Republic, a. s.',
            'address' => 'Vltavská 53,252 63 Roztoky, Cesko'
        ]);
    }
}
