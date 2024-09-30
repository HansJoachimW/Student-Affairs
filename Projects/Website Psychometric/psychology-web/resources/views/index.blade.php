@extends('layouts.app')

@section('title', 'Welcome to the Quiz')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h1 class="card-title">Welcome to the Quiz!</h1>
                    <p class="card-text">This quiz consists of 20 psychological questions that will help us understand your preferences.</p>
                    <!-- Update the route to correctly direct to the quiz questions -->
                    <a href="{{ route('quizzes.index') }}" class="btn btn-primary btn-lg">Start Quiz</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
