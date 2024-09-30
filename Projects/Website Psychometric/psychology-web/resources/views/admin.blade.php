@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="container mt-5">
        <h1>Admin Dashboard</h1>
        <div class="card mt-4">
            <div class="card-body">
                <h3>Welcome, {{ auth()->user()->name }}!</h3>
                <p>This is the admin dashboard. You can manage quizzes, users, results, and more.</p>
            </div>
        </div>
    </div>
@endsection