<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }

    public function Login(Request $request){
        $email = $request->email;
    	$password = $request->password;

    	if(Auth::attempt(['email' => $email,'password' => $password]))
    	{
            return redirect()->route('chatUser');
    	}
		return redirect(route('login'))->with('notify',"Please Try Again!");
    }

    public function Logout()
    {
        Auth::logout();
        return redirect()->route('dang-nhap');
    }
}
