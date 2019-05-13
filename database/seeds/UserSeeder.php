<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!User::where('email', 'ict@esdvfootloose.nl')->first()) {
            User::create([
                'name' => 'ICT committee',
                'email' => 'ict@esdvfootloose.nl',
                'password' => Hash::make('testtest'),
            ]);
        }
        if (!User::where('email', 'pr@esdvfootloose.nl')->first()) {
            User::create([
                'name' => 'PR committee',
                'email' => 'pr@esdvfootloose.nl',
                'password' => Hash::make('NewMerchComingS00n'),
            ]);
        }
    }
}
