<?php

use App\Right;
use App\User;
use App\UserRight;
use Illuminate\Database\Seeder;

class UserRightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::where('email', 'ict@esdvfootloose.nl')->first();
        $adminRight = Right::where('can_manage_items', true)
            ->where('can_manage_orders', true)
            ->where('can_set_orders_paid', true)
            ->first();
        if (!UserRight::where('role_id', $adminRight->id)->where('user_id', $admin->id)->first()) {
            UserRight::create([
                'role_id' => $adminRight->id,
                'user_id' => $admin->id
            ]);
        }
    }
}
