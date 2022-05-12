<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::insert([
            'name'              =>  'Emir Gocmen',
            'email'             =>  'emirgocmenn@hotmail.com',
            'email_verified_at' =>  now(),
            'password'          =>  Hash::make('emirgocmenn@hotmail.com'),
            'remember_token'    =>  Str::random(10),
        ]);

        \App\Models\User::factory(9)->create();
    }
}
