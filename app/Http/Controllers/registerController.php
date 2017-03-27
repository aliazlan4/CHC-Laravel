<?php

namespace App\Http\Controllers;

use Validator;

use Illuminate\Http\Request;

class registerController extends Controller
{
    function showRegisterScreen(){
        // Return user to home if he is already logged in!

        return view('chcAuth.register_basicInfo');
    }

    function checkInfo(Request $request){
      $validator = $this->validator($request->all());

      if($validator->fails())
          return back()->withErrors($validator)->withInput();

      session(['name' => $request->name]);
      session(['username' => $request->username]);
      session(['email' => $request->email]);
      session(['screenWidth' => $request->screenWidth]);
      session(['screenHeight' => $request->screenHeight]);

      return redirect('register/chooseScheme');
    }

    function showSchemes(){
        if(session()->has('username'))
            return view('chcAuth.register_showSchemes');

        return redirect('register');
    }

    function validator($data){
      return Validator::make(
          $data,
          [
              'name' => 'required|min:3|regex:/^[\pL\s\-]+$/u',
              'username' => 'required|min:8|max:20|alpha_num|unique:users',
              'email' => 'required|email|unique:users',
          ]
        );
    }
}
