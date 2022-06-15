<?php

namespace Database\Seeders;

use App\Models\Product;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{

    public function run()
    {
       $faker = Factory::create();

        for ($i=0; $i < 20 ; $i++) {
            Product::create([
                'name' => $faker->name(),
                'price' => $faker->numberBetween(100 , 1000),
                'img' => '1.jpg',
                'desc' => $faker->text(50),
                'category_id' => rand(1 , 3) ,
                'rate' => rand(0 , 5)
           ]);
        }
    }
}
