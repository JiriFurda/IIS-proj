<?php

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



Route::get('/cart', function () {
    return view('cart');
})->name('cart.index');


Route::get('/', 'MedicineController@index');

Route::get('/medicines', 'MedicineController@index')->name('medicines.index');
Route::get('/medicines/{medicine}', 'MedicineController@show')->name('medicines.show');

Route::post('/medicines/{medicine}/cart', 'CartController@store')->name('medicines.store');
Route::post('/cart/update', 'CartController@update')->name('cart.update');
Route::get('/cart/{medicine}/delete', 'CartController@delete')->name('cart.delete');

Route::get('/branches', 'BranchController@index')->name('branches.index');
Route::get('/branches/{branch}', 'BranchController@show')->name('branches.show');

Route::get('/insurance_companies', 'InsuranceComapnyController@index')->name('insurance_companies.index');
Route::get('/insurance_companies/{insuranceCompany}', 'InsuranceComapnyController@show')->name('insurance_companies.show');

Route::get('/suppliers', 'SupplierController@index')->name('suppliers.index');
Route::get('/suppliers/{supplier}', 'SupplierController@show')->name('suppliers.show');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
