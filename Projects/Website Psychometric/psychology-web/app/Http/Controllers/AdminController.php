<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Result;

class AdminController extends Controller
{
    public function index()
    {
        $results = Result::all();
        return view('admin', compact('results'));
    }
}