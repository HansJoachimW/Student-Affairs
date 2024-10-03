@extends('layouts.app')

@section('title', 'Welcome to the Quiz')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h1 class="card-title">Well Being Survey</h1>
                    <p class="card-text">Before you explore our booths in the event, please take your time to fill out our well being survey.</p>
                    <p class="card-text">Please enjoy the event!!</p>
                    <!-- Update the route to correctly direct to the quiz questions -->
                    <a href="{{ route('quizzes.index') }}" class="btn btn-primary btn-lg">Start Quiz</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
