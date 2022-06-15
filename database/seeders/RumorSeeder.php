<?php

namespace Database\Seeders;

use App\Models\Rumor;
use Illuminate\Database\Seeder;

class RumorSeeder extends Seeder
{

    public function run()
    {

        for ($i=0; $i < 4 ; $i++) {
            Rumor::create([
                'product_id' => rand(1 , 20)
            ]);
        }
    }
}
