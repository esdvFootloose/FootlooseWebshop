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
        $right_regular_user = new Right;
        $right_regular_user->name = 'user';
        $right_regular_user->description = 'A regular user';
        $right_regular_user->save();

        $right_admin_user = new Right;
        $right_admin_user->name = 'admin';
        $right_admin_user->description = 'An admin user';
        $right_admin_user->save();
    }
}
