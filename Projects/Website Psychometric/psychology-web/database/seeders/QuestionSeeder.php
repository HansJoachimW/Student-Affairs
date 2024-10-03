<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Question;
use App\Models\Quiz;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define the quizzes
        $quizzes = [
            ['title' => 'Quiz 1', 'description' => 'Pretest'],
            ['title' => 'Quiz 2', 'description' => 'Posttest']
        ];

        // Create the quizzes and their associated questions
        foreach ($quizzes as $quizData) {
            // Create the quiz and store the returned Quiz object
            $quiz = Quiz::create($quizData);

            // Define the questions
            $questions = [
                ['question_text' => 'Dalam 30 hari terakhir, seberapa sering Anda mengalami gelisah?'],
                ['question_text' => 'Dalam 30 hari terakhir, seberapa sering Anda mengalami putus asa?'],
                ['question_text' => 'Dalam 30 hari terakhir, seberapa sering Anda mengalami pikiran yang kacau?'],
                ['question_text' => 'Dalam 30 hari terakhir, seberapa sering Anda merasa mudah marah?'],
                ['question_text' => 'Dalam 30 hari terakhir, sebarapa sering Anda mengalami pikiran kosong?'],
                ['question_text' => 'Dalam 30 hari terakhir, seberapa sering Anda merasa diri tidak berdaya?'],
            ];

            // Create the questions and associate them with the quiz
            foreach ($questions as $questionData) {
                $quiz->questions()->create($questionData); // Use $quiz instead of $pretest
            }
        }
    }
}
