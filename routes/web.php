<?php

use App\Http\Controllers\NewsletterController;
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
    return view('dashboard');
});
Route::get('/newsletter/index', function () {
    return view('newsletter.index');
});
Route::get('/newsletter/edit', function () {
    return view('newsletter.edit');
});
Route::get('/newsletter/create', function () {
    return view('newsletter.create');
});

Route::get('/search' , [NewsletterController::class , 'search']);
