<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function Login(Request $request){
        $ten_dang_nhap = $request->tai_khoan;
    	$mat_khau = $request->mat_khau;

    	if(Auth::attempt(['email' => $ten_dang_nhap,'password' => $mat_khau]))
    	{
    		 return redirect()->route('chatUser');
    	}
		return redirect(route('login'))->with('thongbao',"Sai tài khoản hoặc mật khẩu");
    }

    public function Logout()
    {
    	Auth::logout();
    	return redirect()->route('dang-nhap');
    }
}
