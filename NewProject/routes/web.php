<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ForgetPassController;
use App\Models\ForgottenPassword;
use Illuminate\Http\Request;
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
    return view('Login');
});
Route::resource('login', LoginController::class);
Route::resource('register',RegisterController::class);
Route::get('logout', [LoginController::class,'logout']);
// Route::put('showinfor/{id}',[LoginController::class,'update']);
Route::get('showinfor/{id}',[LoginController::class,'showdata']);
Route::post('updateinfor',[LoginController::class,'updatedata']);
Route::get('home',[Homecontroller::class,'index']);
Route::get('check', function (Request $request) {
    // if($request->Session::get('id')){
    //     return view('Profile');
    // }
    // return view('Login');
    $value = $request->session()->get('id');
    if($value){
        return view('Profile');
    }else{
        return view('Login');
    }
});
Route::get('forgotten',[ForgetPassController::class,'index']);
Route::post('accountverify',[ForgetPassController::class,'verifyAccount']);
Route::get('/user/verify/{token}',[RegisterController::class,'verifyEmail']);
Route::get('manage', function () {
    return view('layouts.ManageBlog');
});
Route::get('edit', function () {
    return view('UpdateArticle');
});
Route::get('article', function () {
    return view('Article');
});
Route::get('sendcode',[ForgetPassController::class,'sendToEmail']);
// Route::get('/pass/verify/{token}',[ForgetPassController::class,'sendToEmail']);