@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $quiz->title }}</h1>
        <p>{{ $quiz->description }}</p>

        <h3>Questions</h3>
        <ul>
            @foreach ($quiz->questions as $question)
                <li>{{ $question->text }}</li>
            @endforeach
        </ul>

        @if (auth()->check())
            <a href="{{ route('quizzes.start', $quiz->id) }}" class="btn btn-primary">Start Quiz</a>
        @else
            <div class="alert alert-warning mt-3">
                <strong>Note:</strong> You need to be logged in to start the quiz.
            </div>
            <a href="{{ route('login') }}" class="btn btn-secondary">Login to Start Quiz</a>
        @endif
    </div>
@endsection
