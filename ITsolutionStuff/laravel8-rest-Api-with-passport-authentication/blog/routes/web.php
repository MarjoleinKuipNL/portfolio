<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FileController;
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
Route::get('file', [FileController::class, 'create']);
Route::get('file', [FileController::class, 'store']);
Route::get('helper', function () {
    $imageName = 'example.png';
    $fullPath = productImagePath($imageName);

    dd($fullPath);
});
Route::get('helper2', function () {
    $newDateFormat = changeDateFormat(date('Y-m-d'),'m/d/Y');

    dd($newDateFormat);
});
