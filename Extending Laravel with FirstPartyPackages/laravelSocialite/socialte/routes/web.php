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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('login/{provider}', 'App\Http\Controllers\Auth\SocialAccountController@redirectToProvider');
Route::get('login/{provider}/callback', 'App\Http\Controllers\Auth\SocialAccountController@handleProviderCallback');

Route::get('post/create', [App\Http\Controllers\PostController::class,'create'])->name('create');
Route::post('post', [App\Http\Controllers\PostController::class,'store'])->name('store');
Route::get('post/{post}/edit', [App\Http\Controllers\PostController::class,'edit'])->name('edit');
Route::get('post/{post}', [App\Http\Controllers\PostController::class,'show'])->name('show');
Route::put('post/{post}', [App\Http\Controllers\PostController::class,'update'])->name('update');
Route::delete('post/{post}', [App\Http\Controllers\PostController::class,'destroy'])->name('destroy');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
