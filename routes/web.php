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
Route::get('/reset_db', function() {
    Artisan::call('migrate:reset');
    Artisan::call('migrate');
    return "Database reset!";
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index');

Route::get('/admin', 'adminController@index')->name('admin');

Route::get('/login', 'loginController@showUsernameScreen')->name('login');
Route::post('/login', 'loginController@checkUsername');
Route::get('/login/authenticate', 'loginController@authenticateUser');
Route::post('/login/authenticate', 'loginController@authenticateUser');
Route::get('/login/passwordImage', 'loginController@passwordImage');

Route::match(['get', 'post'], 'logout', 'logoutController@logoutUser')->name('logout');

Route::get('/register', 'registerController@showRegisterScreen')->name('register');
Route::post('/register', 'registerController@checkInfo');
Route::get('/register/chooseScheme', 'registerController@showSchemes');
Route::post('/register/chooseScheme', 'registerController@setScheme');
Route::get('/register/chooseIcongroup', 'registerController@showIcongroups');
Route::post('/register/chooseIcongroup', 'registerController@setIcongroup');
Route::get('/register/chooseIcons', 'registerController@showIcons');
Route::post('/register/chooseIcons', 'registerController@setIcons');

Route::get('/icons/get/{id}/{width?}', 'iconController@getIcon');
Route::post('/icons/addIconGroup', 'iconController@addIconGroup');
Route::post('/icons/addIcons', 'iconController@addIcons');
Route::post('/icons/otherSettings', 'iconController@saveOtherSettings');

?>
