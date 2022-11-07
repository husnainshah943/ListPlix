<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach(range(1, 30) as $index) {
            DB::table('task_lists')->insert([
                'title' => $faker->sentence(2),
                'description' => $faker->sentence(6),
                'status' => 'done',
                'project_id' => $faker->randomDigit(),
                'user_id' => $faker->randomDigit(),
                'created_at' => $faker->dateTime(),
                'updated_at' => $faker->dateTime(),
            ]);
        }
    }
}
