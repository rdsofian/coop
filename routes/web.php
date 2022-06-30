<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');


    Route::resource('/customer', 'CustomerController');
    Route::get('/customer/loan/{id}', 'CustomerController@loan')->name('customer.loan');
    Route::post('/customer/store-loan', 'CustomerController@storeLoan')->name('customer.store-loan');
    Route::resource('/officer', 'OfficerController');
    Route::resource('/loan', 'LoanController');
    Route::resource('/loan-payment', 'LoanPaymentController');

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('/', 'DashboardController@index');


});

Route::get('/register', 'RegisterController@create')->name('register');
Route::post('/register', 'RegisterController@store')->name('register.store');


