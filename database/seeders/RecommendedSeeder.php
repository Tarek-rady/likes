<?php

namespace Database\Seeders;

use App\Models\Recommended;
use Illuminate\Database\Seeder;

class RecommendedSeeder extends Seeder
{

    public function run()
    {
        for ($i=0; $i < 4 ; $i++) {
            Recommended::create([
                'product_id' => rand(1 , 20)
            ]);
        }
    }
}
