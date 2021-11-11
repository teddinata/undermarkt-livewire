<?php

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

//home
Route::livewire('/', 'frontend.home.index')
->layout('layouts.frontend')->name('root');

Route::group(['middleware' => 'guest'], function(){

    //login page
    Route::livewire('/login', 'console.login')
    ->layout('layouts.auth')->name('console.login');

    //logout page
    Route::livewire('/logout', 'console.logout')
    ->layout('layouts.console')->name('console.logout');

});

Route::prefix('console')->group(function () {

    Route::group(['middleware' => 'auth'], function(){

        //console dashboard
        Route::livewire('/dashboard', 'console.dashboard.index')
        ->layout('layouts.console')->name('console.dashboard.index');

        //console categories
        Route::livewire('/categories', 'console.categories.index')
        ->layout('layouts.console')->name('console.categories.index');

        Route::livewire('/categories/create', 'console.categories.create')
        ->layout('layouts.console')->name('console.categories.create');

        Route::livewire('/categories/edit/{id}', 'console.categories.edit')
        ->layout('layouts.console')->name('console.categories.edit');

        //console products
        Route::livewire('/products', 'console.products.index')
        ->layout('layouts.console')->name('console.products.index');

        Route::livewire('/products/create', 'console.products.create')
        ->layout('layouts.console')->name('console.products.create');

        Route::livewire('/products/edit/{id}', 'console.products.edit')
        ->layout('layouts.console')->name('console.products.edit');

         //console vouchers
         Route::livewire('/vouchers', 'console.vouchers.index')
         ->layout('layouts.console')->name('console.vouchers.index');

         Route::livewire('/vouchers/create', 'console.vouchers.create')
         ->layout('layouts.console')->name('console.vouchers.create');

         Route::livewire('/vouchers/edit/{id}', 'console.vouchers.edit')
         ->layout('layouts.console')->name('console.vouchers.edit');

         //console orders
         Route::livewire('/orders', 'console.orders.index')
         ->layout('layouts.console')->name('console.orders.index');

         Route::livewire('/orders/{id}', 'console.orders.show')
         ->layout('layouts.console')->name('console.orders.show');

         Route::livewire('/orders/status/{id}', 'console.orders.status')
         ->layout('layouts.console')->name('console.orders.status');

         Route::livewire('/orders/receipt/{id}', 'console.orders.receipt')
         ->layout('layouts.console')->name('console.orders.receipt');

         //console payment
        Route::livewire('/payment', 'console.payment.index')
        ->layout('layouts.console')->name('console.payment.index');

        Route::livewire('/payment/{id}', 'console.payment.show')
        ->layout('layouts.console')->name('console.payment.show');

        //console sliders
        Route::livewire('/sliders', 'console.sliders.index')
        ->layout('layouts.console')->name('console.sliders.index');

        //console users
        Route::livewire('/users', 'console.users.index')
        ->layout('layouts.console')->name('console.users.index');

        Route::livewire('/users/create', 'console.users.create')
        ->layout('layouts.console')->name('console.users.create');

        Route::livewire('/users/edit/{id}', 'console.users.edit')
        ->layout('layouts.console')->name('console.users.edit');

         //console settings
         Route::livewire('/settings', 'console.settings.index')
         ->layout('layouts.console')->name('console.settings.index');
    });

});

/**
 * customer auth
 */
//login customer
Route::livewire('/customer/login', 'customer.auth.login')
->layout('layouts.frontend')->name('customer.auth.login');

//register customer
Route::livewire('/customer/register', 'customer.auth.register')
->layout('layouts.frontend')->name('customer.auth.register');

View::composer('*', function($view) {
    $setting = \App\Setting::find(1);
    $view->with('setting', $setting);
});

View::composer('*', function($view) {
    $global_categories = \App\Category::latest()->take(6)->get();
    $view->with('global_categories', $global_categories);
});


    Route::prefix('customer')->group(function (){

        Route::group(['middleware' => 'auth:customer'], function(){
            //dashboard
            Route::livewire('/dashboard', 'customer.dashboard.index')
            ->layout('layouts.frontend')->name('customer.dashboard.index');

            //orders
            Route::livewire('/orders', 'customer.orders.index')
            ->layout('layouts.frontend')->name('customer.orders.index');

            Route::livewire('/orders/{id}', 'customer.orders.show')
            ->layout('layouts.frontend')->name('customer.orders.show');

            //profile
            Route::livewire('/profile', 'customer.profile.index')
            ->layout('layouts.frontend')->name('customer.profile.index');


        });
    });



    Route::get('/provinces', 'ApiController@getProvinces');
    Route::get('/cities', 'ApiController@getCities');
    Route::get('/districts', 'ApiController@getDistricts');
    Route::post('/shipping', 'ApiController@getShipping');
    Route::get('/check_voucher', 'ApiController@check_voucher');
    Route::post('/checkout', 'ApiController@checkout');
    Route::post('/waybill', 'ApiController@getWaybill');


//detail category
Route::livewire('/category/{slug}', 'frontend.category.show')
->layout('layouts.frontend')->name('frontend.category.show');

//cart
Route::livewire('/cart', 'frontend.cart.index')
->layout('layouts.frontend')->name('frontend.cart.index');

//payment after success checkout
Route::livewire('/payment/{invoice_id}', 'frontend.payment.index')
->layout('layouts.frontend')->name('frontend.payment.index')->middleware('auth:customer');

//search
Route::livewire('/search', 'frontend.search.index')
->layout('layouts.frontend')->name('frontend.search.index');
