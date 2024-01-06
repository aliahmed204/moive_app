<?php

use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\GenreController;
use App\Http\Controllers\Dashboard\PasswordController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
/*Home*/
Route::get('/home', [DashboardController::class, 'index'])->name('index');

/*Roles*/
Route::get('/roles/data', [RoleController::class, 'data'])->name('roles.data');
Route::delete('/roles/bulk-delete', [RoleController::class, 'bulk_delete'])->name('roles.bulk_delete');
Route::resource('roles',RoleController::class);

/*Admins*/
Route::get('admins/data',[AdminController::class,'data'])->name('admins.data');
Route::delete('admins/bulk-delete',[AdminController::class , 'bulk_delete'])->name('admins.bulk_delete');
Route::resource('admins',AdminController::class);

/*Users*/
Route::get('users/data',[UserController::class , 'data'])->name('users.data');
Route::delete('users/bulk-delete',[UserController::class , 'bulk_delete'])->name('users.bulk_delete');
Route::resource('users',UserController::class);

/*settings*/
Route::get('settings/general',[SettingController::class , 'general'])->name('settings.general');
Route::resource('settings',SettingController::class);

/*profile*/
Route::group([
    'prefix' => 'profile',
    'as' => 'profile.',
    'controller' => ProfileController::class
],function(){
    Route::get('edit','edit')->name('edit');
    Route::put('update','update')->name('update');
});

/*password*/
Route::group([
    'prefix' => 'password',
    'as' => 'password.',
    'controller' => PasswordController::class
],function(){
    Route::get('edit','edit')->name('edit');
    Route::put('update','update')->name('update');
});

/*Users*/
Route::get('genres/data',[GenreController::class , 'data'])->name('genres.data');
Route::delete('genres/bulk-delete',[GenreController::class , 'bulk_delete'])->name('genres.bulk_delete');
Route::resource('genres',GenreController::class)->only(['index','destroy']);
