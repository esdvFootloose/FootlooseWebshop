<?php

use App\Item;
use App\Stock;
use Illuminate\Database\Seeder;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $item = Item::where('name', 'T-Shirt')->where('gender', 'Male')->first();
        if (count($item->Stock) == 0) {
            $sizes = ['S', 'M', 'L', 'XL', 'XXL'];
            foreach ($sizes as $size) {
                Stock::create([
                    'item_id' => $item->id,
                    'size' => $size,
                    'stock' => rand(0, 15),
                ]);
            }
        }

        $item = Item::where('name', 'T-Shirt')->where('gender', 'Female')->first();
        if (count($item->Stock) == 0) {
            $sizes = ['S', 'M', 'L', 'XL'];
            foreach ($sizes as $size) {
                Stock::create([
                    'item_id' => $item->id,
                    'size' => $size,
                    'stock' => rand(0, 15),
                ]);
            }
        }

        $item = Item::where('name', 'Sweater')->where('gender', 'Male')->first();
        if (count($item->Stock) == 0) {
            $sizes = ['S', 'M', 'L', 'XL', 'XXL'];
            foreach ($sizes as $size) {
                Stock::create([
                    'item_id' => $item->id,
                    'size' => $size,
                    'stock' => rand(0, 15),
                ]);
            }
        }

        $item = Item::where('name', 'Sweater')->where('gender', 'Female')->first();
        if (count($item->Stock) == 0) {
            $sizes = ['XS', 'S', 'M', 'L', 'XL'];
            foreach ($sizes as $size) {
                Stock::create([
                    'item_id' => $item->id,
                    'size' => $size,
                    'stock' => rand(0, 15),
                ]);
            }
        }

        $item = Item::where('name', 'Footloose bag')->first();
        if (count($item->Stock) == 0) {
            $sizes = ['M'];
            foreach ($sizes as $size) {
                Stock::create([
                    'item_id' => $item->id,
                    'size' => $size,
                    'stock' => rand(0, 15),
                ]);
            }
        }

        $item = Item::where('name', 'Towel')->first();
        if (count($item->Stock) == 0) {
            $sizes = ['M'];
            foreach ($sizes as $size) {
                Stock::create([
                    'item_id' => $item->id,
                    'size' => $size,
                    'stock' => rand(0, 15),
                ]);
            }
        }

        $item = Item::where('name', 'Lustrum socks')->first();
        if (count($item->Stock) == 0) {
            $sizes = ['S', 'M', 'L'];
            foreach ($sizes as $size) {
                Stock::create([
                    'item_id' => $item->id,
                    'size' => $size,
                    'stock' => 0,
                ]);
            }
        }
        $item = Item::where('name', 'Lustrum mug')->first();
        if (count($item->Stock) == 0) {
            $sizes = ['M'];
            foreach ($sizes as $size) {
                Stock::create([
                    'item_id' => $item->id,
                    'size' => $size,
                    'stock' => 0,
                ]);
            }
        }

        $item = Item::where('name', 'Lustrum t-shirt')->where('gender', 'Male')->first();
        if (count($item->Stock) == 0) {
            $sizes = ['XS', 'S', 'M', 'L', 'XL', 'XXL', 'XXXL'];
            foreach ($sizes as $size) {
                Stock::create([
                    'item_id' => $item->id,
                    'size' => $size,
                    'stock' => 0,
                ]);
            }
        }

        $item = Item::where('name', 'Lustrum t-shirt')->where('gender', 'Female')->first();
        if (count($item->Stock) == 0) {
            $sizes = ['XS', 'S', 'M', 'L', 'XL', 'XXL'];
            foreach ($sizes as $size) {
                Stock::create([
                    'item_id' => $item->id,
                    'size' => $size,
                    'stock' => 0,
                ]);
            }
        }

        $item = Item::where('name', 'Lustrum canvas bag')->first();
        if (count($item->Stock) == 0) {
            $sizes = ['M'];
            foreach ($sizes as $size) {
                Stock::create([
                    'item_id' => $item->id,
                    'size' => $size,
                    'stock' => 0,
                ]);
            }
        }
    }
}
