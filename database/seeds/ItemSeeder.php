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
        if (!Item::where('name', 'T-Shirt')->where('gender', 'Male')->first()) {
            $item = Item::create([
                'name' => 'T-Shirt',
                'price' => 15,
                'description' => <<<EOT
A basic black Footloose T-shirt with a regular fit, printed both front and back with the Footloose logo
EOT
                ,'gender'=>'Male',
            ]);

        }

        if (!Item::where('name', 'T-Shirt')->where('gender', 'Female')->first()) {
            $item = Item::create([
                'name' => 'T-Shirt',
                'price' => 15,
                'description' => <<<EOT
A basic black Footloose T-shirt with a slim fit, printed both front and back with the Footloose logo
EOT
                ,'gender'=>'Female',
            ]);

        }

        if (!Item::where('name', 'Sweater')->where('gender', 'Male')->first()) {
            $item = Item::create([
                'name' => 'Sweater',
                'gender' => 'Male',
                'price' => 25,
                'description' => <<<EOT
A very comfortable footloose sweater to keep you warm during the colder periods of the year. Of course with the footloose logo on both the front and the back. Also, one of the pockets contains a phoneholder to keep your phone into place.
EOT
            ]);

        }
        if (!Item::where('name', 'Sweater')->where('gender', 'Female')->first()) {
            $item = Item::create([
                'name' => 'Sweater',
                'gender' => 'Female',
                'price' => 25,
                'description' => <<<EOT
A very comfortable footloose sweater to keep you warm during the colder periods of the year. Of course with the footloose logo on both the front and the back. Also, one of the pockets contains a phoneholder to keep your phone into place.
EOT
            ]);

        }

        if (!Item::where('name', 'Sweatpants')->first()) {
            $item = Item::create([
                'name' => 'Sweatpants',
                'gender' => 'Unisex',
                'price' => 15,
                'description' => <<<EOT
A very comfortable footloose sweatpants to keep you warm during the colder periods of the year. Both very suitable for both on and off the dance floor.
EOT
            ]);

        }

        if (!Item::where('name', 'Footloose bag')->first()) {
            $item = Item::create([
                'name' => 'Footloose bag',
                'gender' => 'Unisex',
                'price' => 5,
                'description' => <<<EOT
A shoe bag printed with the Footloose logo to transport your dance shoes from and to the dance floor. This bag has place for two pairs as well as your shoe brush.
EOT
            ]);

        }

        if (!Item::where('name', 'Towel')->first()) {
            $item = Item::create([
                'name' => 'Towel',
                'gender' => 'Unisex',
                'price' => 15,
                'description' => <<<EOT
Take your footloose gear even under the shower, with this comfortable 100x50 cm footloose towel. Or use it to get rid of the sweat from dancing.
EOT
            ]);

        }

        if (!Item::where('name', 'Lustrum socks')->first()) {
            $item = Item::create([
                'name' => 'Lustrum socks',
                'gender' => 'Unisex',
                'price' => 15,
                'description' => <<<EOT
For the sizes, take into account that S refers to size 35-38, M refers to size 39-42, L refers to size 43-46.
We will inform you when the lustrum items you have reserved via this webshop have been ordered. You can pay them with card or cash when you pick them up at Luna. Note that when you place an order, you agree to pay the items when we get them for you.
EOT
            ]);
            // $item->addMediaFromUrl(storage_path('/images/products/lustrum/lustrum-socks.png'))->preservingOriginal()->toMediaColletion('product');

        }

        if (!Item::where('name', 'Lustrum mug')->first()) {
            $item = Item::create([
                'name' => 'Lustrum mug',
                'gender' => 'Unisex',
                'price' => 6.5,
                'description' => <<<EOT
<p>Please note: For the lustrum mugs and t-shirts, we can only order the items in bulk. Therefore, a minimum number of reservations needs to be placed for us to be able to get the items for you. If the minimum reservation number has not been reached when you reserve an item, we will inform you when we will order them! (Just to be clear: the minimum reservation number as noted down below is not per person, but for a whole batch of items. So, tell your friends they need to get a lustrum item as well! &#128513)</p><br>
<p>We will inform you when the lustrum items you have reserved via this webshop have been ordered. You can pay them with card or cash when you pick them up at Luna. Note that when you place an order, you agree to pay the items when we get them for you.</p><br>
<p>Minimum reservation number: 3</p>
EOT
            ]);
            // $item->addMediaFromUrl(storage_path('/images/products/lustrum/lustrum-mug.png'))->preservingOriginal()->toMediaColletion('product');

        }

        if (!Item::where('name', 'Lustrum t-shirt')->where('gender', 'Male')->first()) {
            $item = Item::create([
                'name' => 'Lustrum t-shirt',
                'gender' => 'Male',
                'price' => 16.5,
                'description' => <<<EOT
<p>Please note: For the lustrum mugs and t-shirts, we can only order the items in bulk. Therefore, a minimum number of reservations needs to be placed for us to be able to get the items for you. If the minimum reservation number has not been reached when you reserve an item, we will inform you when we will order them! (Just to be clear: the minimum reservation number as noted down below is not per person, but for a whole batch of items. So, tell your friends they need to get a lustrum item as well! &#128513)</p><br>
<p>We will inform you when the lustrum items you have reserved via this webshop have been ordered. You can pay them with card or cash when you pick them up at Luna. Note that when you place an order, you agree to pay the items when we get them for you.</p><br>
<p>Minimum reservation number: 11</p>
EOT
            ]);
            // $item->addMediaFromUrl(storage_path('/images/products/lustrum/lustrum-t-shirt.png'))->preservingOriginal()->toMediaColletion('product');

        }

        if (!Item::where('name', 'Lustrum t-shirt')->where('gender', 'Female')->first()) {
            $item = Item::create([
                'name' => 'Lustrum t-shirt',
                'gender' => 'Female',
                'price' => 16.5,
                'description' => <<<EOT
<p>Please note: For the lustrum mugs and t-shirts, we can only order the items in bulk. Therefore, a minimum number of reservations needs to be placed for us to be able to get the items for you. If the minimum reservation number has not been reached when you reserve an item, we will inform you when we will order them! (Just to be clear: the minimum reservation number as noted down below is not per person, but for a whole batch of items. So, tell your friends they need to get a lustrum item as well! &#128513)</p><br>
<p>We will inform you when the lustrum items you have reserved via this webshop have been ordered. You can pay them with card or cash when you pick them up at Luna. Note that when you place an order, you agree to pay the items when we get them for you.</p><br>
<p>Minimum reservation number: 11</p>
EOT
            ]);
            // $item->addMediaFromUrl(storage_path('/images/products/lustrum/lustrum-t-shirt.png'))->preservingOriginal()->toMediaColletion('product');

        }
        
        if (!Item::where('name', 'Lustrum canvas bag')->first()) {
            $item = Item::create([
                'name' => 'Lustrum canvas bag',
                'gender' => 'Unisex',
                'price' => 7,
                'description' => <<<EOT
<p>Note: We are still perfecting this design, the placing of the little puppets will differ a bit on the real bags.</p><br>
<p>We will inform you when the lustrum items you have reserved via this webshop have been ordered. You can pay them with card or cash when you pick them up at Luna. Note that when you place an order, you agree to pay the items when we get them for you.</p>
EOT
            ]);

            // $item->addMediaFromUrl(storage_path('/images/products/lustrum/lustrum-bag.png'))->preservingOriginal()->toMediaColletion('product');
        }

    }
}
