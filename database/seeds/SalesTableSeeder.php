<?php

use Illuminate\Database\Seeder;
use App\Medicine;
use App\Branch;
use App\User;
use App\Classes\CartItem;
use App\Sale;

class SalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seedFirst();

        factory(Sale::class, 50)->create();
    }

    private function seedFirst()
    {
        $cartItems[] = new CartItem(Medicine::find(1), 1);
        $cartItems[] = new CartItem(Medicine::find(2), 1);

        Branch::first()->addSale([
            'user_id' => User::first()->id,
            'confirmed' => true,
        ], $cartItems);
    }
}
