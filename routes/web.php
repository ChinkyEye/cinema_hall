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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::namespace('App\Http\Controllers\User')->prefix('user')->name('user.')->middleware(['user'])->group(function(){
    Route::get('/', [App\Http\Controllers\User\HomeController::class, 'index'])->name('home');
    Route::resource('task', TaskController::class );
    Route::patch('/task/{id}/toggle-status', [App\Http\Controllers\User\TaskController::class, 'toggleStatus'])->name('user.task.toggleStatus');
    Route::resource('movie', MovieController::class );
    Route::get('/seat/{movie_id}', [App\Http\Controllers\User\SeatController::class, 'seating'])->name('seat.seating');
    Route::get('/seat/create/{ids}', [App\Http\Controllers\User\SeatController::class, 'createSeat'])->name('seat.createSeating');
    Route::resource('seat', SeatController::class );
    Route::get('seat/isactive/{id}', [App\Http\Controllers\User\SeatController::class, 'isActive'])->name('seat.active');


});
Route::get('/', [App\Http\Controllers\Frontend\FrontController::class, 'index']);
Route::get('/seat/{id}',[App\Http\Controllers\Frontend\SeatController::class, 'show'])->name('seat-show');
Route::post('/book-seats', [App\Http\Controllers\Frontend\BookingController::class, 'bookMultiple']);