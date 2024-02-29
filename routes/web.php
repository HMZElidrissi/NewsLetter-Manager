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


Route::get('/search', [NewsletterController::class, 'search']);
Route::get('/newsletter', [NewsletterController::class, 'index'])->name('newsletter.index');
Route::get('/newsletterfilter', [NewsletterController::class, 'filter'])->name('newletter.filter');
Route::get('/newsletterfilteremail', [NewsletterController::class, 'filterByEmail'])->name('newletter.filterEmail');
