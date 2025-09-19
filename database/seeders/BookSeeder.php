<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use Faker\Factory as Faker;


class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            Book::create([
                   'title' => substr($faker->words(2, true), 0, 10), 
                'author' => substr($faker->firstName, 0, 10), 
                'publishedYear' => $faker->numberBetween(1000, 9999),
            ]);
        }
    }
}
