<?php

namespace App\Http\Controllers\AuthController;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class RegisterController extends Controller
{
    public function handleFormRegister(Request $request)
    {
        $data = $request->all();
        try {
            if (!empty($data)) {
                $user = new User();
                $user->fullname = $data['fullname'];
                $user->email = $data['email'];
                $user->username = $data['username'];
                $user->password = bcrypt($data['password']);
                $user->address = $data['address'];
                $user->phone_number = $data['phone-number'];
                $user->role = 'USER';
                $user->save();
                return redirect('/login')->with('message', 'Register successfully, sign in to continue!');
            }
        } catch (Exception $e) {
            echo $e;
            return redirect()->back()->with('message', 'Your register has error, please check!');
        }
    }
}
