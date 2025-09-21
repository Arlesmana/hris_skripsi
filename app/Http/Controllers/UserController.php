<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
       
        $user = Auth::user();
        

        return view('users.index', compact('user'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role_id' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role_id = $request->role_id;
            $user->password = bcrypt($request->password);
            $user->save();

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }
    public function create()
    {
        return view('users.create');

    }

}