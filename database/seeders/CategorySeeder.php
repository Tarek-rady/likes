<?php

namespace Database\Seeders;

use App\Models\Category;
use Faker\Factory;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{

    public function run()
    {

        $categories = ['Play Station' , 'mobile' , 'ipone'];

        foreach ($categories as $cat) {
           Category::create([
             'name' => $cat
           ]);
        }

    }
}
