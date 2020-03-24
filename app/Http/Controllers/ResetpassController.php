<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ChangePassRequest;

class ResetpassController extends Controller
{
    //
    public function index()
    {
        return view('email');
    }

    public function reset(Request $request)
    {
        $email = $request->email;
        $user = User::where('email', $request->email)->first();
        $name = $user->name;

        // $request->session()->put('name', $name);

        if(!$user)
        {
            return redirect()->back()->with('error','Email not exists!');
        }

        $code = Hash::make($request->email);
        $user->token = $code;
        $user->save();

        $url = route('linkReset',['code' => $user->$code,'email'=> $email]);

        $data = [
            'email' => $email,
            'route' => $url,
            'token' => $code,
        ];

        Mail::send('reset', $data, function($message) use ($email, $name){
            $message->to($email, $name)->subject('Get a password!');
        });

        return redirect()->back()->with('notify','Link get your password send your email!');
    }

    public function linkReset()
    {
         return view('reset');
    }

    public function changePass(Request $request)
    {
        $token = $_GET['token'];
        $email = $_GET['email'];

        if(Hash::check($email, $token)){
            return view('form-reset-password');
        }else{
            return view('Page404.Page404');
        }
    }

    public function processChangePass(Request $request)
    {
        $email =  $_GET['email'];
        $password = Hash::make($request->password);

        DB::update("update users set password = '".$password."' where email = '".$email."'");

        $this->validate($request,
            [
                'password' => 'required|min:6',
                'confirmpassword' => 'required|same:password',
            ],

            [
                'password.required' => 'Please enter your password',
                'confirmpassword.required' => 'Please enter your comfirm password',

                'password.min' => 'Password must be at least 6 characters',

                'confirmpassword.same' => "Password confirmation doesn't match the password",
            ]
        );

        return redirect()->back()->with('notify','Change password success!');
    }
}
