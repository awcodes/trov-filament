<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ArticleController;

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

Route::get('/admin/login', function () {
    return redirect('/login');
})->name('filament.auth.login');

Route::middleware('forceslash')->group(function () {
    Route::name('welcome')->get('/', function () {
        return view('welcome');
    });

    Route::name('articles.show')->get('/articles/{article:slug}', [ArticleController::class, 'show']);
    Route::name('faqs.show')->get('/faqs/{faq:slug}', [FaqController::class, 'show']);
    Route::name('posts.show')->get('/blog/{post:slug}', [PostController::class, 'show']);

    // this needs to be last !!!!!!!!!!!!!!
    Route::name('pages.show')->get('/{page:slug}', [PageController::class, 'show']);
});
