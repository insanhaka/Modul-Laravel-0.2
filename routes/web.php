<?php

use Illuminate\Support\Facades\Route;

// Front-End Route
use App\Http\Controllers\Front_HomeController;
use App\Http\Controllers\Front_AuthController;
use App\Http\Controllers\Front_DashboardController;

// Back-End Route
use App\Http\Controllers\Back_AuthController;
use App\Http\Controllers\Back_DashboardController;

// Super Admin Route
use App\Http\Controllers\Super_DashboardController;
use App\Http\Controllers\Super_UserController;
use App\Http\Controllers\Super_RoleController;
use App\Http\Controllers\Super_MenuController;
use App\Http\Controllers\Super_PermissionController;

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

// Front-end Route
Route::get('/', [Front_HomeController::class, 'index'])->name('home');
Route::get('/masuk', [Front_AuthController::class, 'index'])->name('masuk');
Route::post('/post-masuk', [Front_AuthController::class, 'store']);
Route::get('/logout/user', [Front_AuthController::class, 'logout']);

Route::group(['prefix' => 'user', 'middleware' => 'auth'], function() {

    Route::get('/dashboard', [Front_DashboardController::class, 'index'])->name('dashboard');

});

// Back-end Route
Route::get('/logout/admin', [Back_AuthController::class, 'logout']);
Route::get('/dapur', [Back_AuthController::class, 'index'])->name('dapur');
Route::post('/post-dapur', [Back_AuthController::class, 'store']);

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {

    Route::get('/dashboard', [Back_DashboardController::class, 'index'])->name('control');

});


// Super Admin Route
Route::group(['prefix' => 'super', 'middleware' => 'auth'], function() {
    Route::get('/setting', [Super_DashboardController::class, 'index'])->name('setting');
    Route::get('/dashboard', [Super_DashboardController::class, 'dashboard'])->name('super-control');

    Route::get('/user', [Super_UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [Super_UserController::class, 'create'])->name('user.create');
    Route::post('/user/store', [Super_UserController::class, 'store'])->name('user.store');
    Route::get('/user/{id}/edit', [Super_UserController::class, 'edit'])->name('user.edit');
    Route::post('/user/{id}/update', [Super_UserController::class, 'update'])->name('user.update');
    Route::get('/user/{id}/delete', [Super_UserController::class, 'delete'])->name('user.delete');
    Route::get('/user/{id}/activation/{data}', [Super_UserController::class, 'activation'])->name('user.activation');
    Route::get('/user-serverside', [Super_UserController::class, 'serverside'])->name('user.serverside');

    Route::resource('menu', Super_MenuController::class);
    Route::get('/menu/{id}/delete', [Super_MenuController::class, 'delete'])->name('menu.delete');
    Route::get('/menu/{id}/activation/{data}', [Super_MenuController::class, 'activation'])->name('menu.activation');
    Route::get('/menu-serverside', [Super_MenuController::class, 'serverside'])->name('menu.serverside');

    Route::resource('role', Super_RoleController::class);
    Route::get('/role/{id}/delete', [Super_RoleController::class, 'delete'])->name('role.delete');
    Route::get('/role-serverside', [Super_RoleController::class, 'serverside'])->name('role.serverside');

    Route::resource('permission', Super_PermissionController::class);
    Route::get('/permission/{id}/delete', [Super_PermissionController::class, 'delete'])->name('permission.delete');
    // Route::get('/permission-serverside', [Super_RoleController::class, 'serverside'])->name('role.serverside');

});

