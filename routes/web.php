<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

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
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['prefix' => '',  'namespace' => 'App\Http\Controllers\Admin',  'middleware' => ['auth']], function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::group(['prefix' => ''], function () {
            Route::get('/', 'DashboardController@index')->name('dashboard');
        });

        Route::group(['prefix' => '/peramalan'], function () {
            Route::get('/', 'PeramalanController@index')->name('peramalan');
            Route::get('/data', 'PeramalanController@data')->name('peramalan.data');
            Route::get('/data/export', 'PeramalanController@export')->name('peramalan.export');
        });

        Route::group(['prefix' => '/products'], function () {
            Route::get('/', 'ProductController@index')->name('products');
            Route::get('/data', 'ProductController@data')->name('products.data');
            Route::post('/store', 'ProductController@store')->name('products.store');
            Route::get('/{id}/edit', 'ProductController@show')->name('products.show');
            Route::put('/{id}', 'ProductController@update')->name('products.update');
            Route::delete('/{id}', 'ProductController@destroy')->name('products.delete');
        });

        Route::group(['prefix' => '/stocks'], function () {
            Route::get('/', 'StockController@index')->name('stocks');
            Route::get('/data', 'StockController@data')->name('stocks.data');
            Route::post('/store', 'StockController@store')->name('stocks.store');
            Route::get('/{id}/edit', 'StockController@show')->name('stocks.show');
            Route::put('/{id}', 'StockController@update')->name('stocks.update');
            Route::delete('/{id}', 'StockController@destroy')->name('stocks.delete');
            Route::get('/data/export', 'StockController@export')->name('stocks.export');
        });

        Route::group(['prefix' => '/transactions'], function () {
            Route::get('/', 'TransactionController@index')->name('transactions');
            Route::get('/data', 'TransactionController@data')->name('transactions.data');
            Route::post('/store', 'TransactionController@store')->name('transactions.store');
            Route::get('/{id}/edit', 'TransactionController@show')->name('transactions.show');
            Route::put('/{id}', 'TransactionController@update')->name('transactions.update');
            Route::delete('/{id}', 'TransactionController@destroy')->name('transactions.delete');
            Route::get('/data/export', 'TransactionController@export')->name('transactions.export');
        });

        Route::group(['prefix' => '/users'], function () {
            Route::get('/', 'UserController@index')->name('users');
            Route::get('/data', 'UserController@data')->name('users.data');
            Route::post('/store', 'UserController@store')->name('users.store');
            Route::get('/{id}/edit', 'UserController@show')->name('users.show');
            Route::put('/{id}', 'UserController@update')->name('users.update');
            Route::delete('/{id}', 'UserController@destroy')->name('users.delete');
        });

        Route::group(['prefix' => '/visitors'], function () {
            Route::get('/', 'VisitorController@index')->name('visitors');
            Route::get('/data', 'VisitorController@data')->name('visitors.data');
            Route::post('/store', 'VisitorController@store')->name('visitors.store');
            Route::get('/{id}/edit', 'VisitorController@show')->name('visitors.show');
            Route::put('/{id}', 'VisitorController@update')->name('visitors.update');
            Route::delete('/{id}', 'VisitorController@destroy')->name('visitors.delete');
        });

        Route::group(['prefix' => '/profile'], function () {
            Route::get('/', 'ProfileController@index')->name('profile');
        });
    });
});

Route::get('/cc', function () {
    Artisan::call('optimize:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
});

require __DIR__ . '/auth.php';
