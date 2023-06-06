<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CreatorController;
use App\Http\Controllers\visualizarArtigoController;

/*
|--------------------------------------------------------------------------
|                        Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/home', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('home');

Route::get('/user', function (Request $request) {
    return ['isLoggedIn' => Auth::check()];
});

Route::group(['middleware' => ['web']], function () {
    Route::get('/', function () {
        return view('home');
    });
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/view-content/{id}', [App\Http\Controllers\visualizarArtigoController::class, 'show']);
    Route::post('/view-content/{id}/send-email', [VisualizarArtigoController::class, 'sendEmail']);
});

Auth::routes();

Route::get('/creation', [App\Http\Controllers\TinymceController::class, 'index'])->name('creation');

Route::post('/salvar-conteudo/{id?}', [App\Http\Controllers\CreatorController::class, 'storeOrUpdate']);

Route::get('/report/most-accessed-articles', [App\Http\Controllers\CreatorController::class, 'mostAccessedArticlesReport']);

Route::get('/search', [App\Http\Controllers\CreatorController::class, 'search']);

Route::delete('/creators/{id}', [App\Http\Controllers\CreatorController::class, 'destroy']);

Route::get('/{post}/edit', [App\Http\Controllers\CreatorController::class, 'edit'])->name('posts.edit');

Route::put('/posts/{post}', [App\Http\Controllers\CreatorController::class, 'update'])->name('posts.update');

Route::apiResource('/creators', CreatorController::class);


