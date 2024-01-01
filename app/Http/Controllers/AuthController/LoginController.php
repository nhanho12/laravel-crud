<?php

namespace App\Http\Controllers\AuthController;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function handleFormLogin(Request $request)
    {
        $credentials = $request->only('username', 'password');
        $user = User::where('username', $credentials['username'])->first();
    
        if (!$user) {
            return redirect()->back()->with('message', 'Username does not exist!, try again!');
        }
    
        if (!Hash::check($credentials['password'], $user->password)) {
            return redirect()->back()->with('message', 'Wrong credential, try again!');
        }
    
        if (Auth::attempt($credentials)) {
            $request->session()->put('user', $user);
    
            if ($user->role === 'ADMIN') {
                return redirect('/admin')->with('message', 'Login successfully!');
            }
    
            return redirect('/user')->with('message', 'Login successfully!');
        }
    
        return redirect()->back()->with('message', 'Invalid credentials, try again!');
    }
    

    public function handleFormLogout()
    {
        Session::flush();
        return redirect('/login');
    }
}
