<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware'=>'auth'], function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('user', 'UserController');
    Route::resource('lecturer', 'LecturersController');
    Route::resource('student', 'StudentsController');
    Route::resource('project', 'ProjectController');
    Route::resource('svby', 'SvbyController');
    

    Route::get('profile', 'UserController@profile')->name('user.profile');
    Route::post('profile', 'UserController@postProfile')->name('user.postProfile');    
    
    Route::get('/password/change', 'UserController@getPassword')->name('userGetPassword');
    Route::post('/password/change', 'UserController@postPassword')->name('userPostPassword');
});

Auth::routes();

//denying url bypass
Route::group(['middleware' => ['auth', 'role_or_permission:ADMIN|Create Role|Create Permission']], function(){
    Route::resource('role', 'RoleController');
    Route::resource('permission', 'PermissionController');
});


//////////////////////////// axios request
Route::get('/getAllPermission', 'PermissionController@getAllPermissions'); //view permission

Route::post("/postRole", "RoleController@store"); //create new role

Route::get("/getAllRoles", "RoleController@getAll");                //Create new user form
Route::get("/getAllPermissions", "PermissionController@getAll");    //
Route::get("/getAllClusters", "ClusterController@getAll");          //

Route::get("/getAllUsers", "UserController@getAll");    //view user list
Route::get("/getLects", "UserController@getLects");    //view user list
Route::get("/getStuds", "UserController@getStuds");    //view user list
Route::get("/getSVby", "SvbyController@getSVby");    //view user list


Route::post('/account/create', 'UserController@store');         //create user
Route::put('/account/update/{id}', 'UserController@update');    //update user
Route::delete('/delete/user/{id}', 'UserController@delete');    //softdelete
Route::get('/search/user', 'UserController@search');            //search user
Route::put('/assign/sv', 'SvbyController@assign');

