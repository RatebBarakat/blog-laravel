<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Hash;

class loginController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        $email = $request->input('email');
        $password = $request->input('password');
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $user = User::where('email','=',$request->email)->first();
            Auth::login($user);
            return back();
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    public function register_view()
    {
        return view('register');
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:users',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:8',
            'password_retype' => 'required|same:password',
        ]);
        $user = User::create([
            'name'=>$request->input('name'),
            'password'=>Hash::make($request->input('password')),
            'email'=>$request->input('email'),
        ]);
        if ($user) {
            Auth::login($user);
        return back()->with('success','loged successfully');
        } 
        return back()->with('fail','register fail');
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
