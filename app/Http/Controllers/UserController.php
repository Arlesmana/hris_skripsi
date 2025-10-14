<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role; // 1. Tambahkan use statement untuk model Role

class UserController extends Controller
{
    public function index()
    {
        // Mengambil semua user untuk ditampilkan di halaman index
        $users = User::with('role')->get();
        return view('users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role_id' => 'required|exists:roles,id', // 2. Ubah validasi untuk role_id
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
        // 3. Ambil semua role dan kirim ke view
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }
}