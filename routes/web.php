<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('home');
});

Route::get('register', [App\Http\Controllers\LoginController::class, 'register_form']);
Route::post('register', [App\Http\Controllers\LoginController::class, 'do_register']);

Route::get('login', [App\Http\Controllers\LoginController::class, 'login_form']);
Route::post('login', [App\Http\Controllers\LoginController::class, 'do_login']);

Route::get('logout', [App\Http\Controllers\LoginController::class, 'logout']);

Route::get('profile', [App\Http\Controllers\LoginController::class, 'profile_view']);

Route::get('home', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('home/cards', [App\Http\Controllers\HomeController::class, 'get_cards']);

Route::get('articles', function() {
    return redirect('articles/0/8');
});

Route::get('articles/{offset}/{limit}', [App\Http\Controllers\ArticlesController::class, 'get_articles']);
Route::get('articles/user/{offset}/{limit}', [App\Http\Controllers\ArticlesController::class, 'user_articles']);
Route::get('articles/{id}', [App\Http\Controllers\ArticlesController::class, 'article_view']);
Route::post('articles/check', [App\Http\Controllers\ArticlesController::class, 'check_like']);
Route::post('articles/like', [App\Http\Controllers\ArticlesController::class, 'like_article']);

Route::get('search/{query}', [App\Http\Controllers\SearchController::class, 'search_form']);

Route::get('open_library', [App\Http\Controllers\OpenLibraryController::class, 'fetch']);
Route::get('ip_geolocation', [App\Http\Controllers\IpGeolocationController::class, 'get_geolocation']);
