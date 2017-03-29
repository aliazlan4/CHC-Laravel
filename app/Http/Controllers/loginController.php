<?php

namespace App\Http\Controllers;

use App\User;

use Image;
use Cache;
use Session;
use Auth;
use Illuminate\Http\Request;

class loginController extends helperController
{
    protected $redirectTo = '/home';


    public function showUsernameScreen(){
        // Return user to home if he is already logged in!

        return view('chcAuth.login_username');
    }

    public function checkUsername(Request $request){
        $user = User::where('username', $request->username)->first();

        if($user == null)
            return back()->withErrors(['username'=>'Username Doesnt Exist']);

        session(['username' => $request->username]);
        session(['screenWidth' => $request->screenWidth]);
        session(['screenHeight' => $request->screenHeight]);
        session(['chcRound' => 1]);
        session(['chcWrongTrys' => 0]);
        session(['chcStartTime' => time()]);
        return redirect('login/authenticate');
    }

    public function authenticateUser(Request $request){
        if(!session()->has('username')){
            session()->flush();
            return redirect('login');
        }

        else if((time() - session('chcStartTime')) >= Cache::get('loginSessionTimeout', 60)){
            session()->flush();
            return redirect('login')->withErrors(['timeout'=>'Session timeout']);
        }

        else if ($request->isMethod('post')){
            if(!$request->has('x_val') || !$request->has('y_val'))
                return view('chcAuth.passIcons');

            $click = array($request->x_val, $request->y_val);


            if($this->checkLoginAttempt($click))
                session(['chcRound' => session('chcRound')+1]);
            else
                session(['chcWrongTrys' => session('chcWrongTrys')+1]);

            if(session('chcRound') > Cache::get('chcRounds', 5)){
                return $this->loggingInUser();
            }
            else if(session('chcWrongTrys') >= Cache::get('chcWrongTrys', 3)){
                session()->flush();
                return redirect('login')->withErrors(['wrongPassword'=>'Password is Incorrect']);
            }
            else {
                return view('chcAuth.passIcons');
            }
        }

        else{
            return view('chcAuth.passIcons');
        }
    }

    private function loggingInUser(){
        $user = User::where('username', session('username'))->first();

        session()->flush();

        Auth::login($user);

        if($user->is_admin)
            return redirect(route('admin'));

        return redirect()->intended($this->redirectTo);
    }
}
