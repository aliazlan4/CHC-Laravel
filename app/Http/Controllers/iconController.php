<?php

namespace App\Http\Controllers;

use App\Icon;
use App\iconGroup;

use File;
use Cache;
use Session;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Image;

class iconController extends Controller
{
    public function getIcon($filename){
        $path = storage_path('icons/' . $filename);

        if(!File::exists($path))
            abort(404);

        return Image::make($path)->response();
    }

    public function addIconGroup(Request $request){
        iconGroup::create([
            'name' => $request->groupName
        ]);

        return back();
    }

    public function addIcons(Request $request){
        $iconGroup = $request->iconGroup;
        $icons = $request->icons;

        foreach($icons as $icon){
            $extension = $icon->getClientOriginalExtension();
            $destinationPath = storage_path('icons');
            $name = md5_file($icon->getRealPath()) . "." . $extension;
            $icon->move($destinationPath, $name);

            Icon::create([
                'name' => $name,
                'iconGroup' => $iconGroup
            ]);
        }

        return back();
    }

    public function saveOtherSettings(Request $request){
        Cache::forever('numberOfRows', $request->numberOfRows);
        Cache::forever('numberOfColumns', $request->numberOfColumns);
        Cache::forever('chcRounds', $request->chcRounds);
        Cache::forever('chcWrongTrys', $request->chcWrongTrys);
        Cache::forever('loginSessionTimeout', $request->loginSessionTimeout);
        Cache::forever('chcCentroidThreshold', $request->chcCentroidThreshold);
        Cache::forever('chcBackground', $request->chcBackground);

        session()->flush();
        return back();
    }
}
