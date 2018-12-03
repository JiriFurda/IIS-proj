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
    	Branch::find(1)->medicines()->attach(1, ['amount' => 20]);
    	Branch::find(1)->medicines()->attach(2, ['amount' => 123]);
    	Branch::find(1)->medicines()->attach(3, ['amount' => 42]);

    	Branch::find(2)->medicines()->attach(2, ['amount' => 0]);
    	Branch::find(2)->medicines()->attach(3, ['amount' => 69]);

        Branch::find(3)->medicines()->attach(1, ['amount' => 319]);
        Branch::find(3)->medicines()->attach(2, ['amount' => 88]);
        Branch::find(3)->medicines()->attach(3, ['amount' => 111]);

        Branch::find(4)->medicines()->attach(1, ['amount' => 458]);
        Branch::find(4)->medicines()->attach(2, ['amount' => 22]);
        Branch::find(4)->medicines()->attach(3, ['amount' => 0]);

    }
}
