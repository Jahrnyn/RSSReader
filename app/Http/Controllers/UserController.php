<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\RssController;

class UserController extends Controller
{
    // Welcome / Logged in page:
    public function showCorrectHomePage()
    {
        if (auth()->check()) {
            $rssController = new RssController();
            $subscriptions = $rssController->showSubscriptions();
            
            return view('homepage', compact('subscriptions'));
        } else {
            return view('welcome');
        }
    }
    
    
    // logout
    public function logout() {
        auth()->logout();
        return redirect('/')->with('success', 'You are successfully logged out');
    }

    // login
    public function login(Request $request){
        $incomingFields = $request->validate([
            'loginusername'=> 'required',
            'loginpassword'=> 'required',
        ]);

        if (auth()->attempt(['name' => $incomingFields['loginusername'], 'password' => $incomingFields['loginpassword']])) {
            $request->session()->regenerate();
            return redirect('/')->with('success', 'You are successfully logged in');
        } else {
            return redirect('/')->with('failure', 'Invalid username or password');
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

        $user = User::create($incomingFields);
        auth()->login($user);// auto login after reg. 
        return redirect('/')->with('success', 'Welcome to RSS Reader site');
    }
}
