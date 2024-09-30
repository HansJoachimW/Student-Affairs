@extends('layouts.app')

@section('title', 'Your Result')

@section('content')
    <div class="container mt-5">
        <div class="card text-center shadow-sm">
            <div class="card-body">
                @if (session('logged_in'))
                    <h1 class="display-4">Your Result: {{ $result }}</h1>
                    <p class="lead">Thank you for completing the survey!</p>
                    <a href="{{ url('/') }}" class="btn btn-primary btn-lg">Go Back to Home</a>
                @else
                    <h1 class="display-5 text-danger">{{ session('error') }}</h1>
                    <p class="lead">You need to be logged in to see your results.</p>
                    <a href="{{ url('/login') }}" class="btn btn-primary btn-lg">Login</a>
                @endif
            </div>
        </div>
    </div>
@endsection
