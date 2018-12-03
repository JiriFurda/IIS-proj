<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Branch;
use App\Medicine;

class BranchMedicinePivotTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(Branch::all() as $branch)
        {
            foreach(Medicine::all() as $medicine)
            {
                $branch->medicines()->attach($medicine->id, ['amount' => mt_rand(0,1000)]);
            }
        }

    }
}
