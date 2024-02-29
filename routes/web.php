<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MailController;
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

Route::group(['middleware' => ['jwt']], function () {
    // Protected routes
});

Route::get('/login', [AuthController::class, 'showLoginForm']);
Route::get('/register', [AuthController::class, 'showRegisterForm']);
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/newsletter/{id}/edit',[NewsletterController::class , 'edit'])->name('newsletter.edite');
Route::post('/newsletter/{id}/edit',[NewsletterController::class , 'update'])->name('newsletter.edite');
Route::delete('/newsletter/{id}', [NewsletterController::class, 'destroy'])->name('newsletter.delete');
Route::get('/newsletter/create',[NewsletterController::class , 'create'])->name('newsletter/create');
Route::post('/newsletter/create',[NewsletterController::class , 'store'])->name('newsletter/create');
Route::get('/newsletter/index',[NewsletterController::class , 'index'])->name('newsletter.index');
Route::get('/newsletter/{id}/email',[NewsletterController::class , 'email'])->name('newsletter.email');
Route::post('/newsletter/{id}/email',[NewsletterController::class , 'Sendemail'])->name('newsletter.email');

Route::get('newsletter/search' , [NewsletterController::class , 'search']);
Route::get('/newsletter', [NewsletterController::class, 'index'])->name('newsletter.index');
Route::get('/newsletterfilter', [NewsletterController::class, 'filter'])->name('newletter.filter');
Route::get('/newsletterfilteremail', [NewsletterController::class, 'filterByEmail'])->name('newletter.filterEmail');
Route::get('/newsletterfilter', [NewsletterController::class, 'filter'])->name('newletter.filter');

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

