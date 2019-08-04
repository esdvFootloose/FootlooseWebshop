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
        if (count($item->Stock) == 0)
        {
            $sizes = ['S', 'M', 'L', 'XL', 'XXL'];
            foreach($sizes as $size){
                Stock::create([
                    'item_id' => $item->id,
                    'size' => $size,
                    'stock' => rand(0, 15)
                ]);
            }
        }

        $item = Item::where('name', 'T-Shirt')->where('gender', 'Female')->first();
        if (count($item->Stock) == 0)
        {
            $sizes = ['S', 'M', 'L', 'XL'];
            foreach($sizes as $size){
                Stock::create([
                    'item_id' => $item->id,
                    'size' => $size,
                    'stock' => rand(0, 15)
                ]);
            }
        }

        $item = Item::where('name', 'Sweater')->where('gender', 'Male')->first();
        if (count($item->Stock) == 0)
        {
            $sizes = ['S', 'M', 'L', 'XL', 'XXL'];
            foreach($sizes as $size){
                Stock::create([
                    'item_id' => $item->id,
                    'size' => $size,
                    'stock' => rand(0, 15)
                ]);
            }
        }

        $item = Item::where('name', 'Sweater')->where('gender', 'Female')->first();
        if (count($item->Stock) == 0)
        {
            $sizes = ['XS', 'S', 'M', 'L', 'XL'];
            foreach($sizes as $size){
                Stock::create([
                    'item_id' => $item->id,
                    'size' => $size,
                    'stock' => rand(0, 15)
                ]);
            }
        }

        $item = Item::where('name', 'Sweatpants')->first();
        if (count($item->Stock) == 0)
        {
            $sizes = ['S', 'M', 'L'];
            foreach($sizes as $size){
                Stock::create([
                    'item_id' => $item->id,
                    'size' => $size,
                    'stock' => rand(0, 15)
                ]);
            }
        }

        $item = Item::where('name', 'Footloose bag')->first();
        if (count($item->Stock) == 0)
        {
            $sizes = ['M'];
            foreach($sizes as $size){
                Stock::create([
                    'item_id' => $item->id,
                    'size' => $size,
                    'stock' => rand(0, 15)
                ]);
            }
        }

        $item = Item::where('name', 'Towel')->first();
        if (count($item->Stock) == 0)
        {
            $sizes = ['M'];
            foreach($sizes as $size){
                Stock::create([
                    'item_id' => $item->id,
                    'size' => $size,
                    'stock' => rand(0, 15)
                ]);
            }
        }
    }
}
