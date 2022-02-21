<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\DiscoveryTopicController;
use App\Http\Controllers\DiscoveryArticleController;
use App\Http\Controllers\SitemapController;

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

Route::name('sitemap')->get('/sitemap.xml', [SitemapController::class, 'index']);

Route::middleware('forceslash')->group(function () {
    Route::name('welcome')->get('/', function () {
        return view('welcome');
    });

    Route::name('articles.show')->get('/articles/{article:slug}', [ArticleController::class, 'show']);
    Route::name('faqs.show')->get('/faqs/{faq:slug}', [FaqController::class, 'show']);
    Route::name('posts.show')->get('/blog/{post:slug}', [PostController::class, 'show']);
    Route::name('discovery-topics.show')->get('/discovery-center/topics/{topic:slug}', [DiscoveryTopicController::class, 'show']);
    Route::name('discovery-articles.show')->get('/discovery-center/articles/{article:slug}', [DiscoveryArticleController::class, 'show']);
    Route::name('landing-pages.show')->get('/loans/{page:slug}', [LandingPageController::class, 'show']);

    // this needs to be last !!!!!!!!!!!!!!
    Route::name('pages.show')->get('/{page:slug}', [PageController::class, 'show']);
});
