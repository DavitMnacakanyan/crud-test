<?php

use App\Http\Controllers\{Admin\PostController, Auth\LoginController};
use Illuminate\Support\Facades\{Auth, Route};


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

//auth()->loginUsingId(\App\Models\User::first()->id);

Auth::routes([
    'register' => false
]);

Route::get('logout', [LoginController::class, 'logout']);

Route::middleware('auth')
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {

        Route::get('/', function () {
            return view('welcome');
        });

        // Posts
        Route::resource('/posts', PostController::class)
            ->names('posts');
    });

