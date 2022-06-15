<?php

namespace Database\Seeders;

use App\Models\Specially;
use Illuminate\Database\Seeder;

class SpeciallySeeder extends Seeder
{

    public function run()
    {
        for ($i=0; $i < 4 ; $i++) {
            Specially::create([
                'product_id' => rand(1 , 20)
            ]);
        }
    }
}
