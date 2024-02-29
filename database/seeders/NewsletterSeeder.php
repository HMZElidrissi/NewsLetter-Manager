<?php

namespace Database\Seeders;

use App\Models\Newsletter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;


class NewsletterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // public function run(): void
    // {
    //     Newsletter::factory()
    //         ->count(10)
    //         ->create();
    // }

    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            DB::table('newsletters')->insert([
                'content' => $faker->paragraph,
                'created_at' => now(),
                'updated_at' => now(),
                'category_id' => $faker->numberBetween(1, 5),
                'title' => $faker->sentence,
                'subheader' => $faker->sentence,
                'image' => $faker->imageUrl(640, 480, 'cats', true)
                ]);
        }
    }
}
