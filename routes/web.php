<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AppetizerController;
use App\Http\Controllers\OutputsController;
use App\Http\Controllers\GraphicController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/graphic-charts-data', [GraphicController::class, 'getData']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/appetizer/{appetizer}', [AppetizerController::class, 'update'])->name('appetizer.update');
    Route::resource('appetizer', AppetizerController::class);
    Route::post('appetizer/filters', [AppetizerController::class, 'filters'])->name('appetizer.filters');
    Route::resource('outputs', OutputsController::class);
    Route::post('outputs/filters', [OutputsController::class, 'filters'])->name('outputs.filters');
});

require __DIR__.'/auth.php';
