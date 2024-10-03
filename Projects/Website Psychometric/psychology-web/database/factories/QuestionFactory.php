<?php

namespace Database\Factories;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    protected $model = Question::class;

    public function definition()
    {
        return [
            'quiz_id' => 1, // This should be dynamically assigned in actual use
            'question_text' => $this->faker->sentence,
        ];
    }
}
