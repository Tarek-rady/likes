<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class AdminSeeder extends Seeder
{

    public function run()
    {
        User::create([
            'name' => 'admin' ,
            'email' => 'admin@yahoo.com',
            'password' => Hash::make(12345678) ,
            'mobile' => '01067422197',
            'role_as' => 1 ,
            'email_verified_at'=>now(),
            'remember_token'=>Str::random(10),
        ]);
    }
}
