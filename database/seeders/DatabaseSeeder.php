<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      
      $this->call([
            UserSeeder::class,
            QuizSeeder::class,
            QuestionSeeder::class,
            ResultSeeder::class,
            AnswerSeeder::class,
      ]);  
    }
}
