<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api_AuthorizeController;
use App\Http\Controllers\Super_UserController;
use App\Http\Controllers\Super_RoleController;

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

// Internal API
// Super Admin ------------------------------------------------------------
// User -------------------------------------------------------------------
Route::get('/all-user', [Super_UserController::class, 'all_user']);
Route::post('/user-activation', [Super_UserController::class, 'activation']);
Route::post('/user-store', [Super_UserController::class, 'store']);
Route::post('/user-edit', [Super_UserController::class, 'user_edit']);
Route::post('/user-update', [Super_UserController::class, 'update']);
Route::post('/user-delete', [Super_UserController::class, 'delete']);
// Role -------------------------------------------------------------------
Route::get('/all-role', [Super_RoleController::class, 'all_role']);



Route::group(['middleware' => 'checkHeader'], function() {

    // Api Authorization
    Route::post('/postlogin', [Api_AuthorizeController::class, 'postlogin'])->name('api.login');
    Route::post('/postsignup', [Api_AuthorizeController::class, 'postsignup'])->name('api.signup');
    Route::post('/googlesignup', [Api_AuthorizeController::class, 'googlesignup'])->name('google.login');

});

Route::group(['middleware' => 'auth:api'], function () {

    Route::get('/simple-data-user/{email}', [Api_UserController::class, 'simpledatauser']);

});
