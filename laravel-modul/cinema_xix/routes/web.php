<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\{
    BranchController,
    StudioController,
    MovieController,
    ScheduleController,
    UserController
};

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

Route::prefix("user")->group(function() {
    Route::get('/schedule', [UserController::class, 'schedule'])->name('user.schedule.index');
    Route::post("/schedule/search", [UserController::class, 'search'])->name("user.schedule.search");
});

Route::prefix("admin")->group(function() {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::resource("branch", BranchController::class);
    Route::resource("studio", StudioController::class);
    Route::resource("movie", MovieController::class);

    Route::resource("schedule", ScheduleController::class);
    Route::post("schedule/get-info", [ScheduleController::class, 'getInfo'])->name("schedule.get-more-info");
});