<?php

use App\Http\Controllers\Books\BookController;
use App\Http\Controllers\Books\ReadingController;
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

// reading
Route::resource('/readings', ReadingController::class)
    ->only(['index', 'create', 'store'])
    ->names('readings');

// books and notes
Route::resource('/books', BookController::class)->names('books');
Route::get('/books/{id}/notes/create', [BookController::class, 'createNote'])->name('bookNote.create');
Route::get('/books/{id}/notes/{noteId}/edit', [BookController::class, 'editNote'])->name('bookNote.edit');
Route::put('/books/{id}/notes/{noteId}', [BookController::class, 'updateNote'])->name('bookNote.update');
Route::post('/books/{id}/notes', [BookController::class, 'storeNote'])->name('bookNote.store');


Route::redirect('/', '/readings');

