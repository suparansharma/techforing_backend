<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $req)
    {
        // Create a new User instance
        $user = new User;

        // Set user attributes
        $user->name = $req->input('name');
        $user->email = $req->input('email');
        $user->password = Hash::make($req->input('password'));

        // Save the user to the database
        $user->save();

        // Return a response
        return response()->json(['message' => 'User registered successfully'], 201);
    }
}
