<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $admin = User::create([
            'type' => 'admin',
            'name'=> $faker->name,
            'email'=> 'admin@sltech.com',
            'password' => bcrypt('@sltech<>'),
        ]);
    }
}
