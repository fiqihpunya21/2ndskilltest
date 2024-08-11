<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categorys;

class CategorysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //$faker = \Faker\Factory::create();
        for($i=0;$i<100;$i++){
            Categorys::create([
                'name' => fake()->name(),
                'is_publish' => fake()->boolean()
            ]);
        }
    }
}
