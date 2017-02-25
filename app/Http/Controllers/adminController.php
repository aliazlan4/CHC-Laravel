<?php

namespace App\Http\Controllers;

use App\Icon;
use App\iconGroup;
use Input;
use Illuminate\Http\Request;

class adminController extends Controller
{
    public function index(){
        return view('admin.home', ['iconGroups' => iconGroup::pluck('name', 'id')->all()]);
    }
}
