<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;



class AuthController extends Controller
{
    public function showLoginForm() 
    {
        return view("pages.login");
    }

    function login(Request $request) 
    {
        $request->validate([
            'username' => 'required|string|exists:users,username',
            "password" => "required",
        ]);

        
       // Find user by username
    $user = User::where('username', $request->username)->first();

    if (!$user) {
        return redirect(route("login"))->with("error", "Invalid Username!");
    }

    // Check if the password matches
    if (!Hash::check($request->password, $user->password)) {
        return redirect(route("login"))->with("error", "Incorrect Password!");
    }

    // Attempt login
    if (Auth::attempt($request->only("username", "password"))) {
            return redirect(route("dashboard"));
    }

    return redirect(route("login"))->with("error", "Login failed!");
}

public function showRegistrationForm() 
{
    return view("pages.register");
}

function registerPost(Request $request) 
{
    $request->validate([
        "username" => "required|min:4",
        "gymname" => "required|min:2|max:255",
        "email" => "required|email",
        "password" => "required|min:8|confirmed",
    ]);

    // Check if username already exists
    if (User::where('username', $request->username)->exists()) {
        return redirect(route("register"))->with("error", "Username already exists!");
    }
    // Check if gym name already exists
    if (User::where('gymname', $request->gymname)->exists()) {
        return redirect(route("register"))->with("error", "Gym name already exists!");
    }
    // Check if email already exists
    if (User::where('email', $request->email)->exists()) {
        return redirect(route("register"))->with("error", "Email already exists!");
    }

// Create new user
$user = new User();
$user->username = $request->username;
$user->gymname = $request->gymname;
$user->email = $request->email;
$user->password = Hash::make($request->password);

if ($user->save()) {
    //return redirect()->to(url('http://127.0.0.1:8000')->with('success', 'User created successfully'));
    return redirect(route("login"))->with('success', 'User created successfully');
}

return redirect(route("register"))->with("error", "Failed to create account!");
}
    

}
