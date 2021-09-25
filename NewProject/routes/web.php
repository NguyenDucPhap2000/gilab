<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ForgetPassController;
use App\Models\ForgottenPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResetPassword;
use App\Events\MessageSent;
use App\Http\Controllers\ArticleController;
use App\Models\article;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function (Request $request) {
    $value = $request->session()->get('id');
    if ($value) {
        $data = article::get();
        return view('Home', ['data' => $data]);
    } else {
        return view('Login');
    }
    return view('Home');
});
Route::resource('login', LoginController::class);
Route::resource('register', RegisterController::class);
Route::get('logout', [LoginController::class, 'logout']);
// Route::put('showinfor/{id}',[LoginController::class,'update']);
Route::get('showinfor/{id}', [LoginController::class, 'showdata']);
Route::post('updateinfor', [LoginController::class, 'updatedata']);
Route::get('change', [LoginController::class, 'changePass']);

Route::get('forgotten', [ForgetPassController::class, 'index']);
Route::post('accountverify', [ForgetPassController::class, 'verifyAccount']);
Route::get('/user/verify/{token}', [RegisterController::class, 'verifyEmail']);
Route::get('sendcode', [ForgetPassController::class, 'sendToEmail']);
// Route::get('/pass/verify/{token}',[ForgetPassController::class,'sendToEmail']);
Route::get('/newpass/verify/{url}', [ForgetPassController::class, 'verifyCode']);
Route::post('/resetpassword', [ForgetPassController::class, 'checkcodeReset']);


Route::get('manage', [ArticleController::class, 'show']);
Route::resource('create/article', ArticleController::class);
Route::resource('/home', ArticleController::class);
Route::get('article/{id}/changestatus/{status}', [ArticleController::class, 'changeStatus']);


Route::get('messenger', function () {
    return view('Chat');
});
Route::post('message', function (Request $request) {
    $value = $request->session()->get('id');
    $user = User::where('id', $value)->first();
    broadcast(new MessageSent(Auth('user'), $request->input('message')));
    return $request->input('message');
});
