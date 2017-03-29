<?php

namespace App\Http\Controllers;

use Auth;

use Illuminate\Http\Request;

class logoutController extends Controller
{
    protected $redirectTo = '/';

    public function logoutUser(){
        Auth::logout();

        return redirect($this->redirectTo);
    }
}
