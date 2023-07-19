<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Welcome / Logged in page:
    public function showCorrectHomePage() {
        if (auth()->check()) {
            return view('homepage');
        } else {
            return view('welcome');
        }
    }
    
    // logout
    public function logout() {
        auth()->logout();
        return redirect('/')->with('success', 'You are succesfully logged out');
    }

    // login
    public function login(Request $request){
        $incomingFields = $request->validate([
            'loginusername'=> 'required',
            'loginpassword'=> 'required',
        ]);

        if (auth()->attempt(['name' => $incomingFields['loginusername'], 'password' => $incomingFields['loginpassword']])) {
            $request->session()->regenerate();
            return 'Congrats';
        } else {
            return 'Sorry';
        }
    }
    
    // Registration
    public function registration(Request $request) {
        $incomingFields = $request->validate([
            'name'=> ['required', 'min:4', 'max:20', Rule::unique('users', 'name')],
            'email'=> ['required', 'email', Rule::unique('users', 'email')],
            'password'=> ['required', 'min:8', 'confirmed']
        ]);

        $incomingFields['password'] = bcrypt($incomingFields['password']);

        User::create($incomingFields);
        return 'Hello';
    }
}
