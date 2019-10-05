<?php

use App\Item;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!Item::where('name', 'T-Shirt')->where('gender', 'Male')->first())
        {
            $item = Item::create([
                'name' => 'T-Shirt',
                'price' => 15,
                'description' => <<<EOT
A basic black Footloose T-shirt with a regular fit, printed both front and back with the Footloose logo
EOT
                ,'gender' => 'Male',
            ]);


        }

        if (!Item::where('name', 'T-Shirt')->where('gender', 'Female')->first())
        {
            $item = Item::create([
                'name' => 'T-Shirt',
                'price' => 15,
                'description' => <<<EOT
A basic black Footloose T-shirt with a slim fit, printed both front and back with the Footloose logo
EOT
                ,'gender' => 'Female',
            ]);


        }

        if (!Item::where('name', 'Sweater')->where('gender', 'Male')->first())
        {
            $item = Item::create([
               'name' => 'Sweater',
               'gender' => 'Male',
               'price' => 25,
                'description' => <<<EOT
A very comfortable footloose sweater to keep you warm during the colder periods of the year. Of course with the footloose logo on both the front and the back. Also, one of the pockets contains a phoneholder to keep your phone into place.
EOT
            ]);


        }
        if (!Item::where('name', 'Sweater')->where('gender', 'Female')->first())
        {
            $item = Item::create([
                'name' => 'Sweater',
                'gender' => 'Female',
                'price' => 25,
                'description' => <<<EOT
A very comfortable footloose sweater to keep you warm during the colder periods of the year. Of course with the footloose logo on both the front and the back. Also, one of the pockets contains a phoneholder to keep your phone into place.
EOT
            ]);


        }

        if (!Item::where('name', 'Sweatpants')->first())
        {
            $item = Item::create([
               'name' => 'Sweatpants',
               'gender' => 'Unisex',
               'price' => 15,
                'description' => <<<EOT
A very comfortable footloose sweatpants to keep you warm during the colder periods of the year. Both very suitable for both on and off the dance floor. 
EOT
            ]);

        }

        if (!Item::where('name', 'Footloose bag')->first())
        {
            $item = Item::create([
                'name' => 'Footloose bag',
                'gender' => 'Unisex',
                'price' => 5,
                'description' => <<<EOT
A shoe bag printed with the Footloose logo to transport your dance shoes from and to the dance floor. This bag has place for two pairs as well as your shoe brush. 
EOT
            ]);


        }

        if (!Item::where('name', 'Towel')->first())
        {
            $item = Item::create([
                'name' => 'Towel',
                'gender' => 'Unisex',
                'price' => 15,
                'description' => <<<EOT
Take your footloose gear even under the shower, with this comfortable 100x50 cm footloose towel. Or use it to get rid of the sweat from dancing.
EOT
            ]);


        }
    }
}
