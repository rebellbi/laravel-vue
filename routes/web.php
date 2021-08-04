<?php

use App\Http\Controllers\InfiniteLoadingController;
use App\Http\Controllers\StudentController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('user', App\Http\Controllers\UserController::class);
Route::resource('todo', App\Http\Controllers\Todolistcontroller::class);

Route::get('intro1', [App\Http\Controllers\StudentController::class, 'index']);
Route::get('intro1/list', [App\Http\Controllers\StudentController::class, 'getStudents'])->name('intro1.list');
Route::get('intro2', [StudentController::class, 'intro2']);

Route::get('infinite-loading',[InfiniteLoadingController::class, 'index']);
