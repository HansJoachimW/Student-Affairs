@extends('layouts.app')

@section('title', 'Quiz')

@section('content')
    <div class="container">
        <div class="card shadow-lg p-4" style="border-radius: 15px; background-color: #F0F4F7;">
            <h2 class="text-center" style="color: #4CAF50;">Well Being Survey</h2>
            <form method="POST" action="{{ route('quizzes.submitAnswers') }}">
                @csrf
                <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">

                @foreach ($questions as $question)
                    <div class="mb-4">
                        <p><strong>{{ $question->question_text }}</strong></p>
                        <div class="d-flex justify-content-between">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]"
                                    value="0" required> Tidak Pernah
                            </label>
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]"
                                    value="1"> Kadang-Kadang
                            </label>
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]"
                                    value="2"> Lumayan Sering
                            </label>
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]"
                                    value="3"> Sering Sekali
                            </label>
                        </div>
                    </div>
                @endforeach

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success btn-lg" style="border-radius: 25px; width: 50%;">Submit
                        Answers</button>
                </div>
            </form>
        </div>
    </div>
@endsection
