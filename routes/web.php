<?php

use Illuminate\Support\Facades\Route;
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

// Routes => Find name of functions(create,store,show...) in WEB or API NoteController !!

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

// Routes for Notes:
Route::middleware('auth:web')->group(function () {
    // Route::resource('/notes', 'WEB\NoteController');

    //   Route::get('notes/user/{id}', 'WEB\NoteController@userNotes');
});


Route::get('/notes', [App\Http\Controllers\WEB\NoteController::class, 'index'])->name('notes');
Route::get('/note/create', [App\Http\Controllers\WEB\NoteController::class, 'create'])->name('note.create');
Route::post('/note/store', [App\Http\Controllers\WEB\NoteController::class, 'store'])->name('note.store');
Route::get('/note/show/{id}', [App\Http\Controllers\WEB\NoteController::class, 'show'])->name('note.show');
Route::get('/note/edit/{id}', [App\Http\Controllers\WEB\NoteController::class, 'edit'])->name('note.edit');
Route::post('/note/update/{id}', [App\Http\Controllers\WEB\NoteController::class, 'update'])->name('note.update');
Route::get('/note/destroy/{id}', [App\Http\Controllers\WEB\NoteController::class, 'destroy'])->name('note.destroy');
