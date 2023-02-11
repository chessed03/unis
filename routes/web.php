<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\System\UserController;
use App\Http\Controllers\System\PostController;
use App\Http\Controllers\System\SchoolController;

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

Auth::routes([
    //'register' => false,
    'verify' => true,
    'reset' => false
]);

Route::group(['middleware' => 'auth'], function () {

    # Routes Welcome
    Route::get('/', function () { return view('welcome'); });

    # Routes Dashboard
    Route::get('/dashboard', function() { return view('dashboard'); })->name('dashboard');

    # Routes Home
    Route::controller(HomeController::class)
        ->group(function () {

            Route::get('home', 'index')->name('home');
            Route::get('403', 'unauthorized')->name('403');

        });

    #Routes group of configuration menu
    Route::group(['prefix' => 'configuration'], function () {

        #Routes users
        Route::controller(UserController::class)
            ->prefix('users')
            ->as('user-')
            ->group(function () {

                Route::get('index', 'index')->name('index');

            });

        #Routes posts
        Route::controller(PostController::class)
            ->prefix('posts')
            ->as('post-')
            ->group(function () {

                Route::get('index', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('save-create', 'saveCreate')->name('save-create');
                Route::get('update/{id}', 'update')->name('update');
                Route::post('save-update', 'saveUpdate')->name('save-update');
                Route::post('upload-image', 'uploadImage')->name('upload-image');

            });

        #Routes schools
        Route::controller(SchoolController::class)
            ->prefix('schools')
            ->as('school-')
            ->group(function () {

                Route::get('index', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('save-create', 'saveCreate')->name('save-create');
                Route::get('update/{id}', 'update')->name('update');
                Route::post('save-update', 'saveUpdate')->name('save-update');

            });

    });

});


