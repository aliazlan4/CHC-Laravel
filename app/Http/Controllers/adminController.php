<?php

namespace App\Http\Controllers;

use App\Icon;
use App\iconGroup;
use Input;
use Auth;
use Illuminate\Http\Request;

class adminController extends Controller
{
    public function index(){
        if(Auth::check() && Auth::user()->is_admin)
            return view('admin.home', ['iconGroups' => iconGroup::pluck('name', 'id')->all()]);

        return redirect('/');
    }
}
