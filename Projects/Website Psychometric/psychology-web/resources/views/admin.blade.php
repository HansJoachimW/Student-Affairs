@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="container mt-5">
        <h1>Dashboard</h1>
        <div class="card mt-4">
            <div class="card-body">
                <h3>Welcome, {{ auth()->user()->username }}!</h3>
                <p>This is the admin dashboard. In the future, you can manage quizzes, users, results, and more.</p>
            </div>
        </div>
    </div>
@endsection