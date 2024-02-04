<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\FormFieldController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\UrlShortnerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::get('/', function () {
    return view('frontend.index');
})->name('index');

Auth::routes();
Route::resource('/url', UrlShortnerController::class);
Route::get('/urlxx/{short_url}', [UrlShortnerController::class, 'hits'])->name('url.hits');
Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
Route::resource('/categories', CategoryController::class);
Route::resource('/forms', FormController::class);

Route::resource('/formfields', FormFieldController::class);
Route::resource('/submissions', SubmissionController::class);
Route::resource('/submissions', SubmissionController::class);
Route::group(['middleware' => 'admin'], function () {

    Route::get('/form/{id}', [FormFieldController::class, 'destroy'])->name('formfield.destroy');
});
