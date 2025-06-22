<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
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
    return view('login');
});

// Auth::routes();

Route::middleware(['auth', 'super_admin'])->group(function () {
    // Routes utilisateur accessibles uniquement par les super_admins
    Route::get('/utilisateur/add', [App\Http\Controllers\utilisateurController::class, 'add'])->name('addutilisateur');
    Route::get('/utilisateur/list', [App\Http\Controllers\utilisateurController::class, 'list'])->name('listutilisateur');
    Route::post('/utilisateur/persist', [App\Http\Controllers\utilisateurController::class, 'persist'])->name('persistutilisateur');
    Route::get('/utilisateur/{id}/edit', [App\Http\Controllers\utilisateurController::class, 'edit'])->name('editutilisateur');
    Route::put('/utilisateur/{id}', [App\Http\Controllers\utilisateurController::class, 'update'])->name('updateutilisateur');
    Route::delete('/utilisateur/{id}',[App\Http\Controllers\utilisateurController::class, 'delete'])->name('deleteutilisateur');
});


Route::middleware(['auth'])->group(function () {
    // Routes utilisateur
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');


   



    // Routes catégorie
    Route::get('/categorie/add', [App\Http\Controllers\categorieController::class, 'add'])->name('addcategorie');
    Route::get('/categorie/list', [App\Http\Controllers\categorieController::class, 'list'])->name('listcategorie');
    Route::get('/editcategorie/{id}',  [App\Http\Controllers\categorieController::class, 'editCategory'] )->name('editcategorie');
    Route::put('/updatecategorie/{id}', [App\Http\Controllers\categorieController::class, 'updateCategory']  )->name('updatecategorie');
    Route::post('/categorie/persist', [App\Http\Controllers\categorieController::class, 'persist'])->name('persistcategorie');
    Route::get('/categorie/delete/{id}', [App\Http\Controllers\categorieController::class, 'delete'])->name('deletecategorie');

    // Routes produit
    Route::get('/produit/add', [App\Http\Controllers\produitController::class, 'add'])->name('addproduit');
    Route::get('/produit/list', [App\Http\Controllers\produitController::class, 'list'])->name('listproduit');
    Route::get('/produit/edit/{id}', [App\Http\Controllers\produitController::class, 'edit'])->name('editproduit');
    Route::post('/produit/update', [App\Http\Controllers\produitController::class, 'update'])->name('updateproduit');
    Route::get('/produit/delete/{id}', [App\Http\Controllers\produitController::class, 'delete'])->name('deleteproduit');
    Route::post('/produit/persist', [App\Http\Controllers\produitController::class, 'persist'])->name('persistproduit');
    Route::get('/produit/pdfListeProduit', [App\Http\Controllers\produitController::class, 'pdfListeProduit'])->name('pdfListeProduit');

    // Routes entree
    Route::get('/entree/add', [App\Http\Controllers\entreeController::class, 'add'])->name('addentree');
    Route::delete('/entrees/{id}', [App\Http\Controllers\entreeController::class, 'destroy'])->name('destroyEntree');
    Route::get('/entree/list', [App\Http\Controllers\entreeController::class, 'list'])->name('listentree');
    Route::get('/entree/edit/{id}', [App\Http\Controllers\entreeController::class, 'edit'])->name('editentree');
    Route::post('/entree/update', [App\Http\Controllers\entreeController::class, 'update'])->name('updateentree');
    Route::post('/entree/persist', [App\Http\Controllers\entreeController::class, 'persist'])->name('persistentree');

    // Routes sortie
    Route::get('/sortie/add', [App\Http\Controllers\sortieController::class, 'add'])->name('addsortie');
    Route::delete('/sortie/{id}', [App\Http\Controllers\sortieController::class, 'destroy'])->name('destroysortie');
    Route::get('/sortie/{id}/edit', [App\Http\Controllers\sortieController::class, 'edit'])->name('editsortie');
    Route::put('/sortie/{id}', [App\Http\Controllers\sortieController::class, 'update'] )->name('sortieupdate');

    Route::get('/sortie/list', [App\Http\Controllers\sortieController::class, 'list'])->name('listsortie');
    Route::post('/sortie/persist', [App\Http\Controllers\sortieController::class, 'persist'])->name('persistsortieproduit');

    Route::get('pdfsortie/{id}', [App\Http\Controllers\sortieController::class, 'pdfsortie'])->name('pdfsortie');

});







// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');






Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});




















//Route::post('/produit/persist', [App\Http\Controllers\produitController::class, 'persist'])->name('persistproduit');












