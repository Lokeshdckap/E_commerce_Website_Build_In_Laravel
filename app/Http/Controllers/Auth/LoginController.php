<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginView(){
        return view('auth.login');
    }

    public function authenticates(request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        if(Auth::attempt(['email' => $email, 'password' => $password])){
            $user = User::where('email',$email)->first();

            Auth::login($user);

            if(Auth::user()->is_admin == 1){

                return redirect('/dashboard')->with('status','Welcome to the dashboard Admin');
             }
             else if (Auth::user()->is_admin == 0){
                 return redirect('/')->with('status','Logged is Sucessfully');
             }
        }

        else{
            return back()->withErrors(['Invaild credentials']);
        }
    }


    public function logout(){
        Auth::logout();
        return redirect('/login');
    }



//     protected function authenticate(){
//      if(Auth::check()){
//      if(Auth::user()->is_admin == 1){

//         return redirect('/dashboard')->with('status','Welcome to the dashboard');
//      }
//      else if (Auth::user()->is_admin == 0){
//           return redirect('/')->with('status','Logged is Sucessfully');
//      }
//     }
// }
}
