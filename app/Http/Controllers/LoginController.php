<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /** Handles an authentication requrest. */
    public function authenticate(Request $request)
    {
        // Validates the input.
        $credentials = $request->validate([
            "email" => ["required", "email"],
            "password" => ["required"],
        ]);

        // Attempt login with redirect on success.
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended("home");
        }

        // Throws error
        return back()
            ->withErrors([
                "email" =>
                    "Please check that you've entered the correct details.",
            ])
            ->onlyInput("email");
    }
}
