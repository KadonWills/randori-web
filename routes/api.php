<?php

use App\Http\Controllers\CalendarController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('user/create', [UserController::class, 'create'])->name('user.create');
Route::post('user/edit', [UserController::class, 'edit'])->name('user.edit');
Route::post('user/delete', [UserController::class, 'delete'])->name('user.delete');

Route::get('course/events', [CalendarController::class, 'getEvents'])->name('calendar.events');
Route::post('course/store', [CalendarController::class, 'store'])->name('calendar.store');
