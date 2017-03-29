<?php

namespace App\Http\Controllers;

use App\Icon;
use App\iconGroup;
use App\User;

use Auth;
use Validator;

use Illuminate\Http\Request;

class registerController extends Controller
{
    protected $redirectTo = '/home';


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

    function setScheme(Request $request){
        if(!in_array($request->scheme, array("CHC", "coCHC", "rogueCHC")) || !session()->has('username'))
            return redirect("/");

        session(['chcScheme' => $request->scheme]);

        return redirect('register/chooseIcongroup');
    }

    function showIcongroups(){
        if(!session()->has('username') || !session()->has('chcScheme'))
            return redirect('register');

        $icongroups = iconGroup::get();
        $new_icongroups = collect();
        $icons = array();

        foreach($icongroups as $icongroup){
            if(Icon::where('iconGroup', $icongroup->id)->get()->count() < 50)
                continue;

            $new_icongroups->push($icongroup);
            $temp = Icon::where('iconGroup', $icongroup->id)->inRandomOrder()->take(9)->get(['id'])->toArray();
            array_push($icons,  $temp);
        }

        return view('chcAuth.register_showIcongroups')->with(array('iconGroups' => $new_icongroups, 'icons' => $icons,  'width' => 50));
    }

    function setIcongroup(Request $request){
        if(!in_array($request->icongroup, iconGroup::all('id')->pluck('id')->toArray()) ||
            !session()->has('username') || !session()->has('chcScheme'))
            return redirect("/register");

        session(['iconGroup' => $request->icongroup]);

        return redirect('register/chooseIcons');
    }

    function showIcons(){
        if(!session()->has('username') || !session()->has('chcScheme') || !session()->has('iconGroup'))
            return redirect('register');

        $icons = Icon::where('iconGroup', session('iconGroup'))->get(['id']);

        return view('chcAuth.register_showIcons')->with(array('icons' => $icons, 'minIcons' => 3, 'maxIcons' => 6, 'width' => 70, 'count' => 1));
    }

    function setIcons(Request $request){
        if(!in_array($request->selectedIcons, Icon::all('id')->pluck('id')->toArray()) ||
            !session()->has('username') || !session()->has('username') || !session()->has('iconGroup'))
            return redirect("/register");

        $password = "[" . $request->selectedIcons . "]";

        User::create([
            'name' => session('name'),
            'username' => session('username'),
            'email' => session('email'),
            'passwordScheme' => session('chcScheme'),
            'iconGroup' => session('iconGroup'),
            'password' => $password
        ]);

        return $this->loggingInUser();
    }

    private function loggingInUser(){
        $user = User::where('username', session('username'))->first();

        session()->flush();

        Auth::login($user);

        return redirect()->intended($this->redirectTo);
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
