<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Answer>
 */
class AnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition()
    {
        return [
            'question_id' =>$this->faker->unique()->numberBetween(1,100),
            'answer1'=>$this->faker->sentence(rand(3,7)),
            'answer2'=>$this->faker->sentence(rand(3,7)),
            'answer3'=>$this->faker->sentence(rand(3,7)),
            'answer4'=>$this->faker->sentence(rand(3,7)),
            'correct_answer'=>'answer'.rand(1,4),
        ];
    }
}
