<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/clear_cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    return "Cache Cleared!";
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', 'adminController@index');

//Auth::routes();
Route::get('/login', 'loginController@showUsernameScreen');
Route::post('/login/checkUsername', 'loginController@checkUsername');
Route::get('/login/authenticate', 'loginController@authenticateUser');
Route::get('/login/passwordImage', 'loginController@passwordImage');

Route::get('/home', 'HomeController@index');

Route::get('/icons/{filename}', 'iconController@getIcon');
Route::post('/icons/addIconGroup', 'iconController@addIconGroup');
Route::post('/icons/addIcons', 'iconController@addIcons');
Route::post('/icons/otherSettings', 'iconController@saveOtherSettings');

Route::get('/etc', 'helperController@getAllIcons');

?>
