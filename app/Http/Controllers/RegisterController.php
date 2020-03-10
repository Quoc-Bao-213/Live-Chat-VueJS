<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    private $chatkit;

    public function __construct(){
        $this->chatkit = app('ChatKit');
    }

    public function index(){
        return view("signup");
    }

    public function register(RegisterRequest $request){
        $user = new User;
        $username = $request->username;
        $email =  $request->email;
        $pass = $request->password;
        // $avatar = $request->avatar;
        $id_pusher = strtolower(Str::random(5));

        $this->chatkit->createUser([
            'id' =>  $id_pusher,
            'name' => $request->username,
        ]);

        $check = $user::where('email', $email)->exists();

        if(!$check){
            $user->name = $username;
            $user->email = $email;
            $user->password = Hash::make($pass);
            $user->avatar = "https://via.placeholder.com/150";
            $user->email_verified_at = now();
            $user->remember_token = Str::random(10);
            $user->id_pusher = $id_pusher;
            $user->save();

            return redirect(route("signup"))->with('notify',"Register Successfully!");
        }else{
            return redirect(route("signup"))->with('error',"Your email already exists!");
        }
    }
}
