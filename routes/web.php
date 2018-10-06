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






Route::get('/', 'MedicineController@index');

Route::get('/medicines', 'MedicineController@index')->name('medicines.index');
Route::get('/medicines/create', 'MedicineController@create')->name('medicines.create')->middleware('role:superior');
Route::post('/medicines/create', 'MedicineController@store')->name('medicines.store')->middleware('role:superior');
Route::get('/medicines/{medicine}', 'MedicineController@show')->name('medicines.show');
Route::get('/medicines/{medicine}/edit', 'MedicineController@edit')->name('medicines.edit')->middleware('role:superior');
Route::post('/medicines/{medicine}/edit', 'MedicineController@update')->name('medicines.update')->middleware('role:superior');


Route::post('/medicines/{medicine}/cart', 'CartController@store')->name('medicines.store');
Route::get('/cart', 'CartController@index')->name('cart.index');
Route::post('/cart/update', 'CartController@update')->name('cart.update');
Route::get('/cart/{medicine}/delete', 'CartController@delete')->name('cart.delete');

Route::get('/sales', 'SaleController@index')->name('sales.index');
Route::get('/sales/store', 'SaleController@store')->name('sales.store');
Route::get('/sales/{sale}', 'SaleController@show')->name('sales.show');
Route::get('/sales/{sale}/confirm', 'SaleController@confirm')->name('sales.confirm');

Route::get('/branches', 'BranchController@index')->name('branches.index');
Route::get('/branches/{branch}', 'BranchController@show')->name('branches.show');

Route::get('/insurance_companies', 'InsuranceComapnyController@index')->name('insurance_companies.index');
Route::get('/insurance_companies/{insuranceCompany}', 'InsuranceComapnyController@show')->name('insurance_companies.show');

Route::get('/suppliers', 'SupplierController@index')->name('suppliers.index');
Route::get('/suppliers/{supplier}', 'SupplierController@show')->name('suppliers.show');

Route::get('/reservations/create', 'ReservationController@create')->name('reservations.create');
Route::post('/reservations/store', 'ReservationController@store')->name('reservations.store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
