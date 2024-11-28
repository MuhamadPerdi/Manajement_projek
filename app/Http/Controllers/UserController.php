<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function dashboard()
    {
        $user = Auth::user();
        
        $taskCount = Task::count();
        $projectCount = Project::count();
        return view('dashboard', [
            'projectCount' => $projectCount,
            'taskCount' => $taskCount
        ]);
    }
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->route('register')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('dashboard'); // Ubah ke route yang sesuai setelah login
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('login')
                ->withErrors($validator)
                ->withInput();
        }

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('dashboard'); 
        }

        return redirect()->route('login')->withErrors(['email' => 'Email atau password salah.']);
    }

    public function logout(Request $request)
{
    Auth::logout();

    // Menghapus sesi pengguna
    $request->session()->invalidate();

    // Regenerasi token sesi untuk keamanan
    $request->session()->regenerateToken();

    return redirect()->route('login'); // Ubah ke route yang sesuai setelah logout
}
}
