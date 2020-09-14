<?php
use App\Http\Controllers\Admin\ProductsController;

/*
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register web routes for your application. These
 * | routes are loaded by the RouteServiceProvider within a group which
 * | contains the "web" middleware group. Now create something great!
 * |
 */

/**
 * フロントサイド
 */
Auth::routes();
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');

Route::post('/password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

Route::get('/home', 'HomeController@index')->name('home');

Route::name('front')->namespace('front')
    ->group(function () {
        Route::middleware('auth')->group(function () {
            Route::resource('products', 'ProductsController');
            Route::resource('user', 'UserController');
            Route::resource('wish_products', 'WishProductsController');
        });
    });
/**
 * 管理サイド
 */
Route::prefix('admin')->namespace('Admin')
    ->as('admin.')
    ->group(function () {
    Route::middleware('guest:admin')->group(function () {
        Route::get('login', 'LoginController@showLoginForm')->name('login');
        Route::post('login', 'LoginController@login')->name('login');
    });
    Route::middleware('auth:admin')->group(function () {
        Route::post('logout', 'LoginController@logout')->name('logout');
        Route::get('home', 'HomeController@index')->name('home');
        Route::resource('products', 'ProductsController');
        Route::resource('product_categories', 'ProductCategoriesController');
        Route::resource('users', 'UsersController');
        Route::resource('admin_users', 'AdminUsersController');
    });
});

/**
 * リダイレクト
 */
Route::redirect('/', 'home');
Route::redirect('/admin', '/admin/home');
