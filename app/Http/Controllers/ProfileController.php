<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{
      public function showProfile()
    {
        return view('pages.profile');
    }

  public function update(Request $request, $id)
{
    // Make sure the logged-in user is updating their own profile
    if (Auth::id() != $id) {
        return response()->json([
            'message' => 'Unauthorized'
        ], 403);
    }

    // Validate input
    $validator = Validator::make($request->all(), [
        'username' => 'required|string|min:3|max:255',
        'gymname' => 'required|string|min:3|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $id,
    ]);

    if ($validator->fails()) {
        return response()->json([
            'errors' => $validator->errors()
        ], 422);
    }

    // Update user
    $user = Auth::user();
    $user->username = $request->input('username');
    $user->gymname = $request->input('gymname');
    $user->email = $request->input('email');
    $user->save();

    return response()->json([
        'message' => 'Profile updated successfully.'
    ], 200);
}

public function updatePassword(Request $request)
{
    $validator = Validator::make($request->all(), [
        'password' => 'required|string|min:8|confirmed',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'errors' => $validator->errors()
        ], 422); // 422 = Unprocessable Entity
    }

    $user = auth()->user();
    $user->password = Hash::make($request->password);
    $user->save();

    return response()->json([
        'message' => 'Password changed successfully!'
    ]);
}

}
