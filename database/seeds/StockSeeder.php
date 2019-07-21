<?php

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
        if (!Stock::where('name', 'T-Shirt')
            ->where('gender', 'M')
            ->where('size', 'S')
            ->first()) {
            Stock::create([
                'name' => 'T-Shirt',
                'description' => <<<EOT
                A basic black Footloose T-shirt with a regular fit, printed both front and back with the Footloose logo
EOT
                ,'gender' => 'M',
                'size' => 'S',
                'price' => 15,
                'stock' => 5
            ]);
        }
        if (!Stock::where('name', 'T-Shirt')
            ->where('gender', 'M')
            ->where('size', 'M')
            ->first()) {
            Stock::create([
                'name' => 'T-Shirt',
                'description' => <<<EOT
                A basic black Footloose T-shirt with a regular fit, printed both front and back with the Footloose logo
EOT
                ,'gender' => 'M',
                'size' => 'M',
                'price' => 15,
                'stock' => 10
            ]);
        }
        if (!Stock::where('name', 'T-Shirt')
            ->where('gender', 'M')
            ->where('size', 'L')
            ->first()) {
            Stock::create([
                'name' => 'T-Shirt',
                'description' => <<<EOT
                A basic black Footloose T-shirt with a regular fit, printed both front and back with the Footloose logo
EOT
                ,'gender' => 'M',
                'size' => 'L',
                'price' => 15,
                'stock' => 4
            ]);
        }
        if (!Stock::where('name', 'T-Shirt')
            ->where('gender', 'M')
            ->where('size', 'XL')
            ->first()) {
            Stock::create([
                'name' => 'T-Shirt',
                'description' => <<<EOT
                A basic black Footloose T-shirt with a regular fit, printed both front and back with the Footloose logo
EOT
                ,'gender' => 'M',
                'size' => 'XL',
                'price' => 15,
                'stock' => 3
            ]);
        }
        if (!Stock::where('name', 'T-Shirt')
            ->where('gender', 'M')
            ->where('size', 'XXL')
            ->first()) {
            Stock::create([
                'name' => 'T-Shirt',
                'description' => <<<EOT
                A basic black Footloose T-shirt with a regular fit, printed both front and back with the Footloose logo
EOT
                ,'gender' => 'M',
                'size' => 'XXL',
                'price' => 15,
                'stock' => 2
            ]);
        }
        if (!Stock::where('name', 'T-Shirt')
            ->where('gender', 'F')
            ->where('size', 'S')
            ->first()) {
            Stock::create([
                'name' => 'T-Shirt',
                'description' => <<<EOT
                A basic black Footloose T-shirt with a slim fit, printed both front and back with the Footloose logo
EOT
                ,'gender' => 'F',
                'size' => 'S',
                'price' => 15,
                'stock' => 4
            ]);
        }
        if (!Stock::where('name', 'T-Shirt')
            ->where('gender', 'F')
            ->where('size', 'M')
            ->first()) {
            Stock::create([
                'name' => 'T-Shirt',
                'description' => <<<EOT
                A basic black Footloose T-shirt with a slim fit, printed both front and back with the Footloose logo
EOT
                ,'gender' => 'F',
                'size' => 'M',
                'price' => 15,
                'stock' => 9
            ]);
        }
        if (!Stock::where('name', 'T-Shirt')
            ->where('gender', 'F')
            ->where('size', 'L')
            ->first()) {
            Stock::create([
                'name' => 'T-Shirt',
                'description' => <<<EOT
                A basic black Footloose T-shirt with a slim fit, printed both front and back with the Footloose logo
EOT
                ,'gender' => 'F',
                'size' => 'L',
                'price' => 15,
                'stock' => 7
            ]);
        }
        if (!Stock::where('name', 'T-Shirt')
            ->where('gender', 'F')
            ->where('size', 'XL')
            ->first()) {
            Stock::create([
                'name' => 'T-Shirt',
                'description' => <<<EOT
                A basic black Footloose T-shirt with a slim fit, printed both front and back with the Footloose logo
EOT
                ,'gender' => 'F',
                'size' => 'XL',
                'price' => 15,
                'stock' => 4
            ]);
        }
        if (!Stock::where('name', 'T-Shirt')
            ->where('gender', 'F')
            ->where('size', 'XL')
            ->first()) {
            Stock::create([
                'name' => 'T-Shirt',
                'description' => <<<EOT
                A basic black Footloose T-shirt with a slim fit, printed both front and back with the Footloose logo
EOT
                ,'gender' => 'F',
                'size' => 'XL',
                'price' => 15,
                'stock' => 2
            ]);
        }
        if (!Stock::where('name', 'Sweater')
            ->where('gender', 'M')
            ->where('size', 'S')
            ->first()) {
            Stock::create([
                'name' => 'Sweater',
                'gender' => 'M',
                'size' => 'S',
                'price' => 25,
                'stock' => 8
            ]);
        }
        if (!Stock::where('name', 'Sweater')
            ->where('gender', 'M')
            ->where('size', 'M')
            ->first()) {
            Stock::create([
                'name' => 'Sweater',
                'gender' => 'M',
                'size' => 'M',
                'price' => 25,
                'stock' => 12
            ]);
        }
        if (!Stock::where('name', 'Sweater')
            ->where('gender', 'M')
            ->where('size', 'L')
            ->first()) {
            Stock::create([
                'name' => 'Sweater',
                'gender' => 'M',
                'size' => 'L',
                'price' => 25,
                'stock' => 8
            ]);
        }
        if (!Stock::where('name', 'Sweater')
            ->where('gender', 'M')
            ->where('size', 'XL')
            ->first()) {
            Stock::create([
                'name' => 'Sweater',
                'gender' => 'M',
                'size' => 'XL',
                'price' => 25,
                'stock' => 5
            ]);
        }
        if (!Stock::where('name', 'Sweater')
            ->where('gender', 'M')
            ->where('size', 'XXL')
            ->first()) {
            Stock::create([
                'name' => 'Sweater',
                'gender' => 'M',
                'size' => 'XXL',
                'price' => 25,
                'stock' => 2
            ]);
        }
        if (!Stock::where('name', 'Sweater')
            ->where('gender', 'F')
            ->where('size', 'XS')
            ->first()) {
            Stock::create([
                'name' => 'Sweater',
                'gender' => 'F',
                'size' => 'XS',
                'price' => 25,
                'stock' => 8
            ]);
        }
        if (!Stock::where('name', 'Sweater')
            ->where('gender', 'F')
            ->where('size', 'S')
            ->first()) {
            Stock::create([
                'name' => 'Sweater',
                'gender' => 'F',
                'size' => 'S',
                'price' => 25,
                'stock' => 15
            ]);
        }
        if (!Stock::where('name', 'Sweater')
            ->where('gender', 'F')
            ->where('size', 'M')
            ->first()) {
            Stock::create([
                'name' => 'Sweater',
                'gender' => 'F',
                'size' => 'M',
                'price' => 25,
                'stock' => 12
            ]);
        }
        if (!Stock::where('name', 'Sweater')
            ->where('gender', 'F')
            ->where('size', 'L')
            ->first()) {
            Stock::create([
                'name' => 'Sweater',
                'gender' => 'F',
                'size' => 'L',
                'price' => 25,
                'stock' => 8
            ]);
        }
        if (!Stock::where('name', 'Sweater')
            ->where('gender', 'F')
            ->where('size', 'XL')
            ->first()) {
            Stock::create([
                'name' => 'Sweater',
                'gender' => 'F',
                'size' => 'XL',
                'price' => 25,
                'stock' => 3
            ]);
        }
        if (!Stock::where('name', 'Sweatpants')
            ->first()) {
            Stock::create([
                'name' => 'Sweatpants',
                'gender' => 'U',
                'size' => 'L',
                'price' => 15,
                'stock' => 9
            ]);
        }
        if (!Stock::where('name', 'Footloose bag')
            ->first()) {
            Stock::create([
                'name' => 'Footloose bag',
                'gender' => 'U',
                'price' => 5,
                'stock' => 12
            ]);
        }
        if (!Stock::where('name', 'Towel')
            ->first()) {
            Stock::create([
                'name' => 'Towel',
                'gender' => 'U',
                'description' => 'size 100x50 cm',
                'price' => 15,
                'stock' => 9
            ]);
        }
    }
}
