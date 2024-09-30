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
        $totalPages = ceil($quiz->questions->count() / 5); // Adjust this if you want a different number of questions per page
        $page = request()->query('page', 1); // Retrieve the page number from the query parameter, default to 1

        // Get questions for the current page
        $questions = $quiz->questions->slice(($page - 1) * 5, 5);

        return view('questions', compact('quiz', 'questions', 'page', 'totalPages'));
    }


    public function submitAnswers(Request $request)
    {
        // Get the current page from the request or default to 1
        $page = $request->input('page', 1);

        // Ensure that the quiz_id is available in the request
        $quizId = $request->input('quiz_id');
        if (!$quizId) {
            return redirect()->back()->withErrors('Quiz ID is missing.');
        }

        // Fetch all the questions related to the quiz
        $questions = Question::where('quiz_id', $quizId)->get();
        $totalQuestions = $questions->count();
        $questionsPerPage = 5; // Number of questions per page
        $totalPages = ceil($totalQuestions / $questionsPerPage);

        // Get the submitted answers from the request
        $answers = $request->except('_token', 'page', 'quiz_id');

        // Process and save answers here (if needed)

        // Redirect to the next page or to the results
        if ($page < $totalPages) {
            return redirect()->route('quizzes.showQuestions', ['id' => $quizId, 'page' => $page + 1]);
        } else {
            return redirect()->route('result', ['result' => 'Good']); // Modify this logic based on actual result calculation
        }
    }


    public function showResult()
    {
        return view('result', ['result' => 'Good']);
    }
}
