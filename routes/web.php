<?php

use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\UserController;
use ied3vil\LanguageSwitcher\Facades\LanguageSwitcher;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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
//     $chartjs = app()->chartjs
//          ->name('barChartTest')
//          ->type('pie')
//          ->size(['width' => 400, 'height' => 200])
//          ->labels(['Label x', 'Label y'])
//          ->datasets([
//              [
//                  "label" => "My First dataset",
//                  'backgroundColor' => ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)'],
//                  'data' => [69, 59]
//              ],
//              [
//                  "label" => "My First dataset",
//                  'backgroundColor' => ['rgba(255, 99, 132, 0.3)', 'rgba(54, 162, 235, 0.3)'],
//                  'data' => [65, 12]
//              ]
//          ])
//          ->options([]);
//     return view('dashboard', compact('chartjs'));
// });

Route::get('/', [UserController::class, 'index'])->name('dashboard');
Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar');
Route::get('/course', [CourseController::class, 'index'])->name('course');
Route::get('/members', [MemberController::class, 'students'])->name('students');
Route::get('/trainers', [MemberController::class, 'trainers'])->name('trainers');
Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics');

Route::get('dashboard/data', [UserController::class, 'getUsersDT'])->name('dashboard.data');
Route::get('courses/data', [CourseController::class, 'getOfferedCoursesDT'])->name('courses.data');
Route::get('students/data', [UserController::class, 'getStudentsDT'])->name('students.data');
Route::get('trainers/data', [UserController::class, 'getTrainersDT'])->name('trainers.data');


Route::get('/i18n/{locale}', function ($locale) {
    if (! in_array($locale, ['en', 'de', 'fr'])) {
        abort(400);
    }
    LanguageSwitcher::setLanguage($locale);
});
