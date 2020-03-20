<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

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
        $user = User::where('email',$request->email)->first();
        
       if(!$user)
       {
           return redirect()->back()->with('error','Email not exists!');
       }

       $code = Hash::make($request->email);
       $user->code = $code;
       $user->time_code = Carbon::now();
       $user->save();

       $url = route('linkReset',['code' => $user->$code,'email'=> $email]);

       $data = [
        'email' => $email,
        'route' => $url,
        'token' => $code
       ];


       Mail::send('reset',$data, function($message) use ($email){
            $message->to($email, 'Reset Password')->subject('Get a password!');
        });
       return redirect()->back()->with('notify','Link get your password send your email!');
    }

    public function linkReset()
    {
         return view('reset');
    }

    public function changePass()
    {
        $token =  $_GET['token'];    
        $email =  $_GET['email'];   
        if(Hash::check( $email ,  $token)){
            return view('form-reset-password');
        }else{
            echo('ffff');

        }
    }
    public function processChangePass(Request $request)
    {
        $email =  $_GET['email'];   
        $password = Hash::make($request->password);
        DB::update("update users set password = '".$password."' where email = '".$email."'");
        return redirect()->back()->with('notify','Change password  success!');
    }
}
