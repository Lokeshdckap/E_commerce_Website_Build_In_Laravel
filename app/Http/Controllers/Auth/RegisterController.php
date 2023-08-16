<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
class RegisterController extends Controller
{
   public function registerView(){
    return view('auth.register');
   }

   public function store(request $request){
      $request->validate([
        'username'=>'required',
        'email'=>'required|email',
        'password'=>'required',
        'password_confirmation'=> 'required|same:password'
      ]);

        $user = new User;
        $user->name = $request->input('username');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->password_confirmation = Hash::make($request->input('password_confirmation'));

        $user->save();

        Mail::send('auth.email.register',[$request->input('email')],function($message) use($request){
            $message->to($request->input('email'));
            $message->subject('Welcome To E-Commerce');
         });
        Auth::login($user);

        return redirect('/');

   }
}
