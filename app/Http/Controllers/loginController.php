<?php

namespace App\Http\Controllers;

use App\User;

use Image;
use Cache;
use Illuminate\Http\Request;

class loginController extends helperController
{
    public function showUsernameScreen(){
        return view('chcAuth.login_username');
    }

    public function checkUsername(Request $request){
        $user = User::where('username', $request->username)->first();

        if($user == null)
            return back()->withErrors(['username', 'Username Doesnt Exist']);

        Cache::put('username', $request->username, Cache::get('loginSessionTimeout', 1));
        return redirect('login/authenticate');
    }

    public function authenticateUser(){

    }

    public function passwordImage(){
        $icons = $this->getAllIcons();

        $img = Image::canvas(1366, 768, '#ff0000');
        return $img->response();
    }
}
