<?php

namespace Database\Factories;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    protected $model = Question::class;

    public function definition()
    {
        return [
            'question_text' => $this->faker->sentence(), // Generate a random sentence
            'quiz_id' => 1, // Assuming you have a quiz with ID 1; adjust as needed
        ];
    }
}
