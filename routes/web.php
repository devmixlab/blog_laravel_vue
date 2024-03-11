<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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


Route::get('/', [\App\Http\Controllers\BlogController::class, 'home'])->name('home');
Route::get('/tags', [\App\Http\Controllers\BlogController::class, 'tags'])->name('tags');
Route::get('/latest', [\App\Http\Controllers\BlogController::class, 'latest'])->name('latest');
Route::get('/latest/article/{post}', [\App\Http\Controllers\BlogController::class, 'latestArticle'])
    ->name('latest.article');
Route::get('/article/{post}', [\App\Http\Controllers\BlogController::class, 'article'])
    ->name('article');

Route::middleware(['auth', 'verified'])
    ->prefix('/dashboard')
    ->as('dashboard.')
    ->namespace('\App\Http\Controllers\Dashboard')
    ->group(function () {
        Route::get('/', 'DefaultController@index')
            ->name('index');

        Route::delete('/post/destroy-all', 'PostController@destroyAll')
            ->name('post.destroy_all');
        Route::resource('post', 'PostController');

        Route::delete('/category/destroy-all', 'TagController@destroyAll')
            ->name('category.destroy_all');
        Route::resource('category', 'TagController', [
            'parameters' => [
                'category' => 'tag'
            ]
        ]);

        Route::get('/latest', 'LatestController@index')
            ->name('latest');
        Route::get('/latest/posts', 'LatestController@posts')
            ->name('latest_posts');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
