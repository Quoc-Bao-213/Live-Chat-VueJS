<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function index(){
        return view('signin');
    }

    public function Login(LoginRequest $request){
        $email = $request->email;
    	$password = $request->password;

    	if(Auth::attempt(['email' => $email,'password' => $password]))
    	{
            return redirect(route('homepage'));
    	}
		return redirect(route('signin'))->with('notify',"Please Try Again!");
    }

    public function Logout()
    {
        Auth::logout();
        return redirect()->route('signin');
    }
}
