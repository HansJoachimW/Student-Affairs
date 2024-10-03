@extends('layouts.app')

@section('title', 'Your Results')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-lg p-4" style="border-radius: 15px; background-color: #F0F4F7;">
            <div class="card-body text-center">
                @if (session('logged_in'))
                    <h1 class="display-4 mb-4">Your Results</h1>
                    <p class="lead">Thank you for completing the surveys! Below are your results:</p>

                    @if ($quiz1)
                        <div class="result-section mt-5 p-4 mx-auto" style="background-color: #ffffff; border-radius: 10px; max-width: 400px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);">
                            <h3 class="text-info">Quiz 1 Result</h3>
                            <p class="mt-3"><strong>Analysis:</strong> {{ $quiz1->analysis }}</p>
                        </div>
                    @else
                        <p class="text-warning mt-4">Please finish Quiz 1 to see your result.</p>
                    @endif

                    @if ($quiz2)
                        <div class="result-section mt-5 p-4 mx-auto" style="background-color: #ffffff; border-radius: 10px; max-width: 400px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);">
                            <h3 class="text-info">Quiz 2 Result</h3>
                            <p class="mt-3"><strong>Analysis: </strong> {{ $quiz2->analysis }}</p>
                        </div>
                    @else
                        <p class="text-warning mt-4">Please finish Quiz 2 to see your result.</p>
                    @endif

                    <a href="{{ url('/') }}" class="btn btn-success btn-lg mt-5" style="border-radius: 25px;">Go Back to Home</a>
                @else
                    <h1 class="display-5 text-danger">{{ session('error') }}</h1>
                    <p class="lead">You need to be logged in to see your results.</p>
                    <a href="{{ url('/login') }}" class="btn btn-primary btn-lg mt-4">Login</a>
                @endif
            </div>
        </div>
    </div>
@endsection
