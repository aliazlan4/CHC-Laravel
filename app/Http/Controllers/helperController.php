<?php

namespace App\Http\Controllers;

use App\User;
use App\Icon;

use Cache;
use Image;
use Illuminate\Http\Request;

class helperController extends Controller
{
    public function getPassIcons(){
        $password = json_decode(User::where('username', session('username'))->first()->password);
        $icons = Icon::whereIn('id', $password)->get(['id', 'name']);

        foreach($icons as $icon)
            $icon->is_passIcon = true;

        return $icons;
    }

    public function getRandomIcons(){
        $password = json_decode(User::where('username', session('username'))->first()->password);
        $number = (Cache::get('numberOfRows', 8) * Cache::get('numberOfColumns', 10)) - count($password);

        $icons = Icon::
            where('iconGroup', User::where('username', session('username'))->first()->iconGroup)
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

    public function passwordImage(){
        session()->forget('passX');
        session()->forget('passY');
        $icons = $this->getAllIcons();
        $columns = Cache::get('numberOfColumns', 10);
        $rows = Cache::get('numberOfRows', 8);
        $columnSize = floor(session('screenWidth') / $columns);
        $rowSize = floor(session('screenHeight') / $rows);

        $img = Image::canvas(session('screenWidth'), session('screenHeight'), '#' . Cache::get('chcBackground', 'FFFFFF'));

        $count = 0;
        for($i = 0; $i < $rows; $i++){
            for($j = 0; $j < $columns; $j++){
                $x_size = $rowSize-5;
                $y_size = $rowSize-5;
                $offset = ($columnSize - $x_size ) / 2;
                $x = ($j * $columnSize) + $offset + 5;
                $y = $i * $rowSize + 5;
                $temp = Image::make(storage_path('icons/' . $icons->get($count)->name))->resize($x_size, $y_size);
                $img->insert($temp, 'top-left', $x, $y);

                if($icons->get($count)->is_passIcon){
                    session()->push('passX', $x + ($x_size/2));
                    session()->push('passY', $y + ($y_size/2));
                }

                $count++;
            }
        }

        $this->createConvexHull();

        $img->polygon($this->getPointsArray(), function ($draw) {
            $draw->border(1, '#ff0000');
        });

        $center = $this->getCenter();
        $img->circle(Cache::get('chcCentroidThreshold', 100), $center[0], $center[1], function ($draw) {
            $draw->border(1, '#0000FF');
        });

        return $img->response();
    }

    public function getPointsArray(){
        $x_array = session('passHullX');
        $y_array = session('passHullY');
        $array = array();

        for($i = 0; $i < count($x_array); $i++)
            array_push($array, $x_array[$i], $y_array[$i]);

        return $array;
    }

    public function checkLoginAttempt($click){
        $scheme = User::where('username', session('username'))->first()->passwordScheme;

        switch ($scheme){
            case 'chc':
                return true;
            case 'cochc':
                $center = $this->getCenter();
                $distance = $this->getDistance($click, $center);
                if($distance <= (Cache::get('chcCentroidThreshold', 100) / 2))
                    return true;
                return false;
            default:
                return false;
        }
    }

    public function createConvexHull(){
        $x_array = session('passX');
        $y_array = session('passY');
        $array = array();

        for($i = 0; $i < count($x_array); $i++)
            array_push($array, array($x_array[$i], $y_array[$i]));

        $hull = new convexHullController( $array );
        $array = $hull->getHullPoints();

        session()->forget('passHullX');
        session()->forget('passHullY');

        for($i = 0; $i < count($array); $i++){
            session()->push('passHullX', $array[$i][0]);
            session()->push('passHullY', $array[$i][1]);
        }
    }

    function getCenter() {
        $polygon = array();
        $x_array = session('passHullX');
        $y_array = session('passHullY');

        for($i = 0; $i < count($x_array); $i++)
            array_push($polygon, array($x_array[$i], $y_array[$i]));
        array_push($polygon, array($x_array[0], $y_array[0]));

        $NumPoints = count($polygon);

        if($polygon[$NumPoints-1] == $polygon[0]){
            $NumPoints--;
        }else{
            //Add the first point at the end of the array.
            $polygon[$NumPoints] = $polygon[0];
        }

        $x = 0;
        $y = 0;

        $lastPoint = $polygon[$NumPoints - 1];

        for ($i=0; $i<=$NumPoints - 1; $i++) {
            $point = $polygon[$i];
            $x += ($lastPoint[0] + $point[0]) * ($lastPoint[0] * $point[1] - $point[0] * $lastPoint[1]);
            $y += ($lastPoint[1] + $point[1]) * ($lastPoint[0] * $point[1] - $point[0] * $lastPoint[1]);
            $lastPoint = $point;
        }

        $x /= 6*$this->ComputeArea($polygon);
        $y /= 6*$this->ComputeArea($polygon);

        return array(abs($x), abs($y));
    }

    function ComputeArea($polygon){
        $NumPoints = count($polygon);

        if($polygon[$NumPoints-1] == $polygon[0]){
            $NumPoints--;
        }else{
            //Add the first point at the end of the array.
            $polygon[$NumPoints] = $polygon[0];
        }

        $area = 0;

        for ($i = 0; $i < $NumPoints; $i++) {
          $i1 = ($i + 1) % $NumPoints;
          $area += ($polygon[$i][1] + $polygon[$i1][1]) * ($polygon[$i1][0] - $polygon[$i][0]);
        }

        $area /= 2;
        return $area;
    }

    function getDistance($point1, $point2){
        return sqrt(pow($point1[0]-$point2[0],2) + pow($point1[1]-$point2[1],2));
    }
}
