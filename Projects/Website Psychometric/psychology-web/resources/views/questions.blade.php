@extends('layouts.app')

@section('title', 'Questions')

@section('content')
    @if (auth()->check())
        <!-- Check if user is logged in using Laravel's auth helper -->
        <div class="card shadow-sm">
            <div class="card-body">
                <h2 class="text-center">Page {{ $page }} of {{ $totalPages }}</h2>
                <form method="POST" action="{{ route('questions.submit') }}">
                    @csrf
                    @foreach ($questions as $idx => $question)
                        <div class="mb-4">
                            <p><strong>{{ $question['question_text'] }}</strong></p>
                                <input type="hidden" name="quiz" value="{{ $quiz }}">
                                <input type="hidden" name="page" value="{{ $page }}">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question_{{ $idx }}"
                                    value="Strongly Disagree" required>
                                <label class="form-check-label">Strongly Disagree</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question_{{ $idx }}"
                                    value="Disagree">
                                <label class="form-check-label">Disagree</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question_{{ $idx }}"
                                    value="Neutral">
                                <label class="form-check-label">Neutral</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question_{{ $idx }}"
                                    value="Agree">
                                <label class="form-check-label">Agree</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question_{{ $idx }}"
                                    value="Strongly Agree">
                                <label class="form-check-label">Strongly Agree</label>
                            </div>
                        </div>
                    @endforeach
                    <div class="text-center">
                        <button type="submit" class="btn btn-success btn-lg">Next</button>
                    </div>
                </form>
            </div>
        </div>
    @else
        <div class="card text-center shadow-sm mt-5">
            <div class="card-body">
                <h1 class="display-5 text-danger">Please login first</h1>
                <p class="lead">You need to be logged in to see the quiz questions.</p>
                <a href="{{ url('/login') }}" class="btn btn-primary btn-lg">Login</a>
            </div>
        </div>
    @endif
@endsection
