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
        $username = $request->input('username');
        $password = $request->input('password');

        $user = User::where('username', $username)->first();
        if (!empty($user)) {
            if (Hash::check($password, $user->password)) {
                return redirect('/admin')->with([
                    'message' => 'Login successfully!',
                    $request->session()->put('user', $user)
                ]);
            } else {
                return redirect()->back()->with('message', 'Wrong credential, try again!');
            }
        } else {
            return redirect()->back()->with('message', 'Username does not exist!, try again!');
        }
    }

    public function handleFormLogout()
    {
        Session::forget('user');
        return redirect('/login');
    }
}
