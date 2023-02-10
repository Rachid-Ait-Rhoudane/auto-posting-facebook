<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\Page;
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
    return view('welcome');
});

Route::get('auth/facebook', [UserController::class, 'redirectToFacebook']);

Route::get('auth/facebook/callback', [UserController::class, 'facebookCalback']);

Route::get('/facebook/login', [UserController::class, 'facebookSignin']);

Route::get('/facebook/getpages', [UserController::class, 'connect_to_facebook_pages']);

Route::get('getpages/facebook/callback', [UserController::class, 'connect_to_facebook_pages_callback']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/posts', function () {
        return view('posts');
    })->name('posts');

    Route::get('/pages', [UserController::class, 'pages'])->name('pages');

    Route::get('/add/facebook/post', [UserController::class, 'add_post'])->name('add.post');

    Route::get('/edit/facebook/post/{post}', [UserController::class, 'edit_post'])->name('edit.post');
});

