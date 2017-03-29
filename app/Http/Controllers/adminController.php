<?php

namespace App\Http\Controllers;

use App\Icon;
use App\iconGroup;
use App\User;
use Input;
use Auth;
use Illuminate\Http\Request;

class adminController extends Controller
{
    public function index(){
        if((Auth::check() && Auth::user()->is_admin) || User::all()->count() < 1)
            return view('admin.home', ['iconGroups' => iconGroup::pluck('name', 'id')->all()]);

        return redirect('/');
    }
}
