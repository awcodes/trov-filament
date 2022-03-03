<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\WhitePageController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\DiscoveryTopicController;
use App\Http\Controllers\DiscoveryArticleController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\WelcomeController;

Route::get('/admin/login', function () {
    return redirect('/login');
})->name('filament.auth.login');

Route::name('sitemap')->get('/sitemap.xml', [SitemapController::class, 'index']);

Route::middleware('forceslash')->group(function () {
    Route::name('welcome')->get('/', [WelcomeController::class, 'show']);
    Route::name('faqs.show')->get('/faqs/{faq:slug}/', [FaqController::class, 'show']);
    Route::name('posts.show')->get('/blog/{post:slug}/', [PostController::class, 'show']);
    Route::name('discovery-topics.show')->get('/discovery-center/topics/{topic:slug}/', [DiscoveryTopicController::class, 'show']);
    Route::name('discovery-articles.show')->get('/discovery-center/articles/{article:slug}/', [DiscoveryArticleController::class, 'show']);
    Route::name('landing-pages.show')->get('/loans/{page:slug}/', [LandingPageController::class, 'show']);
    Route::name('author-list')->get('/authors/{author:slug}', function () {
        return 'author list goes here';
    });
    Route::name('white-pages.show')->get('/{type}/{page:slug}/', [WhitePageController::class, 'show']);

    // this needs to be last !!!!!!!!!!!!!!
    Route::name('pages.show')->get('/{page:slug}', [PageController::class, 'show']);
});
