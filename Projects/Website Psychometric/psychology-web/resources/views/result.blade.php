@extends('layouts.app')

@section('title', 'Your Result')

@section('content')
    <div class="container mt-5">
        <div class="card text-center shadow-sm">
            <div class="card-body">
                <h1 class="display-4">Your Result: {{ $result }}</h1>
                <p class="lead">Thank you for completing the survey!</p>
                <a href="{{ url('/') }}" class="btn btn-primary btn-lg">Go Back to Home</a>
            </div>
        </div>
    </div>
@endsection
