<?php

use App\Right;
use Illuminate\Database\Seeder;

class RightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!Right::where('can_manage_items', true)
            ->where('can_manage_orders', true)
//            ->where('can_set_orders_paid', true)
            ->first()) {
            Right::create([
                'can_manage_items' => true,
                'can_manage_orders' => true,
//                'can_set_orders_paid' => true
            ]);
        }
    }
}
