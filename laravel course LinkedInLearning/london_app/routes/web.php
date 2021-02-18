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


Route::get('/', 'App\Http\Controllers\ContentsController@home');
Route::get('/clients', 'App\Http\Controllers\ClientController@index');
Route::get('/clients/new', 'App\Http\Controllers\ClientController@newClient');
Route::post('/clients/new', 'App\Http\Controllers\ClientController@create');
Route::post('/clients/{$client_id}', 'App\Http\Controllers\ClientController@show');
Route::get('/about', function () {
    $response_array = [];
    $response_array['author'] = "Marjolein";
    $response_array['version'] = "0.0.1";
    return $response_array;
    // return view('welcome');
});

Route::get('/contact', function () {
    $data = [];
    $data['version'] = "0.0.1";
    return view('welcome', $data);
    // return view('welcome');
});
Route::get('/di', 'ClientController@di');

Route::get('/facades/db', function () {
   return DB::select('SELECT * FROM table');
});
Route::get('/facades/encrypt', function () {
    return Crypt::encrypt('123456789');
 });

 // eyJpdiI6ImIzb0hNZzlDUEJub3BuTzQ4cTJyNGc9PSIsInZhbHVlIjoiUHQ0bE9jSXQ4YmJvSmwvb1EzZ1BkV05scENqVlIzN09WeXk2aTRhWkdSMD0iLCJtYWMiOiJmYmVlZGM4ZDE0NmUwY2YzOTkwZTVmNzM0MTc0MmEyOGNlODc0MTZkMTE5ZTM0NzIzODE1MTkwNzQ1ZDI2NmRiIn0=

 Route::get('/facades/decrypt', function () {
    return Crypt::decrypt('eyJpdiI6ImIzb0hNZzlDUEJub3BuTzQ4cTJyNGc9PSIsInZhbHVlIjoiUHQ0bE9jSXQ4YmJvSmwvb1EzZ1BkV05scENqVlIzN09WeXk2aTRhWkdSMD0iLCJtYWMiOiJmYmVlZGM4ZDE0NmUwY2YzOTkwZTVmNzM0MTc0MmEyOGNlODc0MTZkMTE5ZTM0NzIzODE1MTkwNzQ1ZDI2NmRiIn0=');
 });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
