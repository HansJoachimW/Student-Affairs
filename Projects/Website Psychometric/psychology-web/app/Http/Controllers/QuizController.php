<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    const QUESTIONS_PER_PAGE = 5;

    public function index()
    {
        $quizzes = Quiz::all(); // Fetch all quizzes
        return view('quizzes', compact('quizzes'));
    }

    public function showQuestions($id)
    {
        $quiz = Quiz::with('questions')->findOrFail($id); // Assuming 'questions' is the relationship
        return view('questions', compact('quiz'));
    }

    public function submitAnswers(Request $request)
    {
        // Get the current page from the query string
        $page = $request->query('page', 1);

        // Fetch all the questions related to the quiz
        $questions = Question::where('quiz_id', $request->quiz_id)->get(); // Make sure you have quiz_id available in your request
        $totalQuestions = $questions->count();
        $questionsPerPage = 5; // Define how many questions per page you want
        $totalPages = ceil($totalQuestions / $questionsPerPage); // Calculate total pages

        // Get the submitted answers from the request
        $answers = $request->except('_token');

        // Process answers here (e.g., save to the database)

        // Redirect to the next page or to the results
        if ($page < $totalPages) {
            return redirect()->route('questions', ['page' => $page + 1]);
        } else {
            return redirect()->route('result', ['result' => 'Good']); // Adjust the logic to determine the actual result
        }
    }

    public function showResult()
    {
        return view('result', ['result' => 'Good']);
    }
}
