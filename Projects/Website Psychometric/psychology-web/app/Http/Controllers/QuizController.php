<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Answers;
use App\Models\Result;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    const QUESTIONS_PER_PAGE = 5;

    public function index()
    {
        $quizzes = Quiz::all();

        // Check if the logged-in user has completed Quiz 1
        $quiz1Result = Result::where('user_id', auth()->id())->where('quiz_id', 1)->exists();

        return view('quizzes', compact('quizzes', 'quiz1Result'));
    }


    public function showQuestions($id)
    {
        $quiz = Quiz::with('questions')->findOrFail($id);

        // Retrieve all questions for the quiz
        $questions = $quiz->questions()->get();

        // Since all questions will be shown on a single page
        $totalQuestions = $questions->count();
        $page = 1; // There's only one page now
        $totalPages = 1;

        return view('questions', compact('quiz', 'questions', 'page', 'totalPages'));
    }

    public function submitAnswers(Request $request)
    {
        // Ensure that the quiz_id is available in the request
        $quizId = $request->input('quiz_id');
        if (!$quizId) {
            return redirect()->back()->withErrors('Quiz ID is missing.');
        }

        // Retrieve the submitted answers from the request
        $submittedAnswers = $request->input('answers', []);

        // Retrieve all the questions for this quiz
        $questions = Question::where('quiz_id', $quizId)->get();

        // Initialize totals for D, A, and S
        $total = 0;

        // Process the collected answers to calculate the scores
        foreach ($questions as $question) {
            $questionType = $question->type; // Assuming 'type' is D, A, or S
            $answerValue = $submittedAnswers[$question->id] ?? 0; // Retrieve the answer value for this question

            $total += (int) $answerValue;
        }

        // Calculate severity levels
        $analysis = $this->calculateSeverity($total, $quizId);

        // Save the results to the results table
        Result::create([
            'user_id' => auth()->id(),
            'quiz_id' => $quizId,
            'result' => $total,
            'analysis' => $analysis,
        ]);

        // Redirect to the results page
        return redirect()->route('result');
    }


    private function calculateSeverity($score, $quizId)
    {
        if ($quizId == 1) {
            if ($score >= 13) return "It may be tough now, but remember, this too shall pass. You can get through this.";
            if ($score >= 0) return "You've done an amazing job! Don't forget to recharge your batteries!";
        } else {
            if ($score >= 13) return "It may be tough now, but remember, this too shall pass. Keep your head up. Better days are ahead. If you need someone to talk to, please reach out to [Counseling Buddy] or [Counseling Center SA].";
            if ($score >= 0) return "I'm so proud of everything you've done. Keep up the good work, but remember to take breaks when you need them!";
        }

        return 'Unknown';
    }

    public function showResults()
    {
        $userId = auth()->id();

        // Get the latest pretest (Quiz 1) result for the logged-in user
        $quiz1 = Result::where('user_id', $userId)->where('quiz_id', 1)->latest()->first();

        // Get the latest posttest (Quiz 2) result for the logged-in user
        $quiz2 = Result::where('user_id', $userId)->where('quiz_id', 2)->latest()->first();

        return view('result', compact('quiz1', 'quiz2'));
    }
}
