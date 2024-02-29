<?php

use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MailController;
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

// Route::get('/', function () {
//     return view('dashboard');
// });


Route::get('/search' , [NewsletterController::class , 'search']);
//Route for categorie
//Page
Route::get('/categoriePage',[CategoryController::class,'index']);

//Traitement 
Route::get('/categoriesAddPage',[CategoryController::class,'categoriesAddPage']);
Route::get('/deleteCategory' , [CategoryController::class,'deleteCategory']) ;
Route::post('/addcategorie' , [CategoryController::class,'addcategorie']) ;

Route::get('/pageUpdateCategory',[CategoryController::class, 'pageUpdateCategory']);

Route::post('/updateCategory',[CategoryController::class, 'updateCategory']);

//Route for Email
Route::get('/emailpage',[MailController::class,'showemail']);
Route::get('/deleteEmail' , [MailController::class,'deleteEmail']);

Route::get('/emailAddPage',[MailController::class,'emailAddPage']);
Route::post('/addemail' , [MailController::class,'addemail']) ;

Route::get('/pageUpdateMail',[MailController::class, 'pageUpdateMail']);
Route::post('/updateEmail',[MailController::class, 'updateEmail']);





















//pour recherche de categorie
// Route::get('pagerecherche',[CategoryController::class,'recherchecategorie']);









