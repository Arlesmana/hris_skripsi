<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        // Fetch the logged-in user's data
        $user = Auth::user();

        // Pass the user data to the view
        return view('users.index', compact('user'));
    }
}
