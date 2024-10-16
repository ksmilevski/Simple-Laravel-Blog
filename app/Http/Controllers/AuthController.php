<?php

namespace App\Http\Controllers;

use App\Events\UserSubscribed;
use App\Http\Controllers\Controller;
use App\models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request){
        //validate
        $fields=$request->validate([
            'username' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:3',
        ]);

        //register
        $user = User::create($fields);

        //login
        Auth::login($user);

        event(new Registered($user));

        if ($request->subscribe){
            event(new UserSubscribed($user));
        }

        //redirect
        return redirect()->route('dashboard');
    }

    public function verifyNotice()
    {
            return view('auth.verify-email');

    }
    public function verifyEmail(EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect()->route('dashboard');
    }
    public function verifyHandler (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }

    public function login(Request $request){
        $fields=$request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($fields,$request->remember)){
            return redirect()->intended('dashboard');
        }else{
            return back()->withErrors([
               'failed'=>'The provided credentials do not match our records.',
            ]);
        }
    }

    public function logout(Request $request){
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/');

    }
}
