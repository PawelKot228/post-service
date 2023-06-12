<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    Route::resource('posts', PostController::class)->except(['index', 'show']);
    Route::resource('posts.comments', CommentController::class)->except(['index', 'show']);
});


Route::resource('posts', PostController::class)->only(['index', 'show']);
Route::resource('posts.comments', CommentController::class)->only(['index', 'show']);

Route::get('/', function () {
    return to_route('posts.index');
});
