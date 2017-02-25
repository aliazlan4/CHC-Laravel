<?php

namespace App\Http\Controllers;

use App\User;
use App\Icon;

use Cache;
use Illuminate\Http\Request;

class helperController extends Controller
{
    public function getPassIcons(){
        $password = json_decode(User::where('username', Cache::get('username'))->first()->password);
        $icons = Icon::whereIn('id', $password)->get(['id', 'name']);

        foreach($icons as $icon)
            $icon->is_passIcon = true;

        return $icons;
    }

    public function getRandomIcons(){
        $password = json_decode(User::where('username', Cache::get('username'))->first()->password);
        $number = Cache::get('maxIconsOnScreen') - count($password);

        $icons = Icon::
            where('iconGroup', User::where('username', Cache::get('username'))->first()->iconGroup)
            ->whereNotIn('id', $password)
            ->inRandomOrder()
            ->take($number)
            ->get(['id', 'name']);

        foreach($icons as $icon)
            $icon->is_passIcon = false;

        return $icons;
    }

    public function getAllIcons(){
        $icons = $this->getRandomIcons();
        $pass_icons = $this->getPassIcons();

        foreach($pass_icons as $icon)
            $icons->push($icon);

        return $icons->shuffle();
    }
}
