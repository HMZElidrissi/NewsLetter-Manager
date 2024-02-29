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


Route::get('/newsletter/{id}/edit',[NewsletterController::class , 'edit'])->name('newsletter.edite');
Route::post('/newsletter/{id}/edit',[NewsletterController::class , 'update'])->name('newsletter.edite');
Route::delete('/newsletter/{id}', [NewsletterController::class, 'destroy'])->name('newsletter.delete');
Route::get('/newsletter/create',[NewsletterController::class , 'create'])->name('newsletter/create');
Route::post('/newsletter/create',[NewsletterController::class , 'store'])->name('newsletter/create');
Route::get('/newsletter/index',[NewsletterController::class , 'index'])->name('newsletter.index');
Route::get('/newsletter/{id}/email',[NewsletterController::class , 'email'])->name('newsletter.email');
Route::post('/newsletter/{id}/email',[NewsletterController::class , 'Sendemail'])->name('newsletter.email');

Route::get('/search', [NewsletterController::class, 'search']);
Route::get('/newsletter', [NewsletterController::class, 'index'])->name('newsletter.index');
Route::get('/newsletterfilter', [NewsletterController::class, 'filter'])->name('newletter.filter');
Route::get('/newsletterfilteremail', [NewsletterController::class, 'filterByEmail'])->name('newletter.filterEmail');
Route::get('/newsletterfilter', [NewsletterController::class, 'filter'])->name('newletter.filter');
