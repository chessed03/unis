<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\System\UserController;

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

    #Routes group of configs menu
    Route::group(['prefix' => 'configs'], function () {

        #Routes users
        Route::controller(UserController::class)
            ->prefix('users')
            ->as('user-')
            ->group(function () {

                Route::get('index', 'index')->name('index');

            });

    });

});


