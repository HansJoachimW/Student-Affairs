@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Select a Quiz</h1>
        <div class="card shadow-lg p-4" style="border-radius: 15px; background-color: #F0F4F7;">
            <div class="card-body">
                <div class="row justify-content-center">
                    @foreach ($quizzes as $quiz)
                        <div class="col-md-6 mb-4">
                            <div class="result-section p-4 mx-auto" style="background-color: #ffffff; border-radius: 10px; max-width: 400px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);">
                                <h5 class="card-title font-weight-bold text-center">{{ $quiz->title }}</h5>
                                <p class="card-text text-muted text-center">
                                    @if ($quiz->id == 1)
                                        Before you hop around and see what's going on in Mental Health Week, please take your time to finish this quiz first.
                                    @else
                                        Now that you've gone around the booths in Mental Health Week, please take your time to fill out this quiz.
                                    @endif
                                </p>

                                @if ($quiz->id == 1 || ($quiz->id == 2 && $quiz1Result))
                                    <!-- Enable Quiz 1 or Quiz 2 if Quiz 1 is completed -->
                                    <a href="{{ route('quizzes.showQuestions', $quiz->id) }}" class="btn btn-primary btn-lg w-100">
                                        Start {{ $quiz->title }}
                                    </a>
                                @elseif ($quiz->id == 2 && !$quiz1Result)
                                    <!-- Disable Quiz 2 if Quiz 1 is not completed -->
                                    <button class="btn btn-secondary btn-lg w-100" disabled>
                                        Complete Quiz 1 to Unlock This Quiz
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
