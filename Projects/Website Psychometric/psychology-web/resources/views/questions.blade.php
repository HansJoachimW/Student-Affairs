@extends('layouts.app')

@section('title', 'Questions')

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <h2 class="text-center">Page {{ $page }} of {{ $total_pages }}</h2>
            <form method="POST" action="{{ route('questions.submit', ['page' => $page]) }}">
                @csrf
                @foreach ($questions as $idx => $question)
                    <div class="mb-4">
                        <p><strong>{{ $question }}</strong></p>
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
@endsection