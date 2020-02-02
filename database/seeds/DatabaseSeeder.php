<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        $this->call(ItemSeeder::class);

        $this->call(StockSeeder::class);

        // $this->call(UserSeeder::class);

        $this->call(RightSeeder::class);

        $this->call(UserRightSeeder::class);
    }
}
