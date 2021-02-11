<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ReadingController;
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

Route::resource('/readings', ReadingController::class)->names('readings');

Route::resource('/books', BookController::class)->names('books');

Route::get('/', function () {
    return redirect('/readings');
    //return redirect()->action([ReadingController::class, 'index']); // it has to exist the '/reading' route
});

