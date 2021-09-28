<?php

use App\Http\Controllers\testApi;
use App\Models\article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//Protected route
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/posts/search/{title}', [testApi::class, 'search']);
});


//public route
Route::resource('posts', testApi::class);
