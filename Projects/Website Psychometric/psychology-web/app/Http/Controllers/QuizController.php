<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Result;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    const QUESTIONS_PER_PAGE = 5;

    public function index()
    {
        return view('index');
    }

    public function showQuestions(Request $request)
    {
        $page = $request->query('page', 1);
        $questions = Question::where('quiz_id', 1)
            ->skip(($page - 1) * self::QUESTIONS_PER_PAGE)
            ->take(self::QUESTIONS_PER_PAGE)
            ->get();

        $totalQuestions = Question::where('quiz_id', 1)->count();
        $totalPages = ceil($totalQuestions / self::QUESTIONS_PER_PAGE);

        return view('questions', [
            'questions' => $questions,
            'page' => $page,
            'total_pages' => $totalPages
        ]);
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
