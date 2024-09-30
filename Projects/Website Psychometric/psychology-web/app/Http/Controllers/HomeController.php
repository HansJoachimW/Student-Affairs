<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Return the view for the home page
        return view('index'); // This will load the 'home.blade.php' view
    }
}
