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
//     return redirect('/contact');
// });

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contact', function () {
    return view('contact_page');
})->name('contact_page');

Route::post('/formSubmit', [\App\Http\Controllers\InquiryController::class, 'store'])
    ->name('contact-form');

//laravel ui auth routes
// Auth::routes();
//
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
