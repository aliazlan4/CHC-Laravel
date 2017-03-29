<?php

namespace App\Http\Controllers;

use App\Icon;
use App\iconGroup;

use File;
use Cache;
use Session;
use Auth;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Image;

class iconController extends Controller
{
    public function getIcon($id, $width = null){
        $icon = Icon::where('id', $id)->first();

        $path = storage_path('icons/' . $icon->name);

        if(!File::exists($path))
            abort(404);

        $img = Image::make($path);

        if($width != null){
            $img->resize($width, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }

        return $img->response();
    }

    public function addIconGroup(Request $request){
        if($this->userIsAdmin()){
            iconGroup::create([
                'name' => $request->groupName
            ]);

            return back();
        }
    }

    public function addIcons(Request $request){
        $iconGroup = $request->iconGroup;
        $icons = $request->icons;

        foreach($icons as $icon){
            $extension = $icon->getClientOriginalExtension();
            $destinationPath = storage_path('icons');
            $name = md5_file($icon->getRealPath()) . "." . $extension;
            $icon->move($destinationPath, $name);

            $newIcon = Icon::create([
                'name' => $name,
                'iconGroup' => $iconGroup
            ]);

            $this->resizeIcon($newIcon);
        }

        return back();
    }

    public function resizeIcon($icon){
        $temp = Image::make(storage_path('icons/' . $icon->name));
        $temp->resize(120, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $temp->save(null, 30);
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

    private function userIsAdmin(){
        if(Auth::check() && Auth::user()->is_admin)
            return true;
        else
            return redirect('/');
    }
}
