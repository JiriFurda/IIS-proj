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



// Public pages
Auth::routes();

// Pages for signed users
Route::middleware('auth')->group(function () {
    // Homepage
    Route::get('/', 'MedicineController@index')->name('home');

    // Medicines
    Route::get('/medicines', 'MedicineController@index')->name('medicines.index');
    Route::middleware('role:superior')->group(function () {
        Route::get('/medicines/create', 'MedicineController@create')->name('medicines.create');
        Route::post('/medicines/create', 'MedicineController@store')->name('medicines.store');
        Route::get('/medicines/{medicine}/edit', 'MedicineController@edit')->name('medicines.edit');
        Route::post('/medicines/{medicine}/edit', 'MedicineController@update')->name('medicines.update');
    });
    Route::get('/medicines/{medicine}', 'MedicineController@show')->name('medicines.show'); // @warning Must be after routes with '/medicines/create'

    // Supply
    Route::get('/supply', 'SupplyController@create')->name('supply.create');
    Route::post('/supply/store', 'SupplyController@store')->name('supply.store');

    // Cart
    Route::post('/medicines/{medicine}/cart', 'CartController@store')->name('medicines.store');
    Route::get('/cart', 'CartController@index')->name('cart.index');
    Route::get('/cart/erase', 'CartController@earse')->name('cart.erase');
    Route::post('/cart/update', 'CartController@update')->name('cart.update');
    Route::get('/cart/{medicine}/delete', 'CartController@delete')->name('cart.delete');

    // Sales
    Route::get('/sales', 'SaleController@index')->name('sales.index');
    Route::get('/sales/store', 'SaleController@store')->name('sales.store');
    Route::get('/sales/create_prescripted', 'SaleController@createPrescripted')->name('sales.create_prescripted');
    Route::post('/sales/store_prescripted', 'SaleController@storePrescripted')->name('sales.store_prescripted');
    Route::get('/sales/{sale}', 'SaleController@show')->name('sales.show');
    Route::get('/sales/{sale}/confirm', 'SaleController@confirm')->name('sales.confirm');

    // Branches
    Route::get('/branches', 'BranchController@index')->name('branches.index');
    Route::get('/branches/{branch}', 'BranchController@show')->name('branches.show');
    Route::middleware('role:superior')->group(function () {
        Route::get('/branches/{branch}/switch', 'BranchController@switch')->name('branches.switch');
    });
    // Insruance comapnies
    Route::get('/insurance_companies', 'InsuranceComapnyController@index')->name('insurance_companies.index');
    Route::middleware('role:superior')->group(function () {
        Route::get('/insurance_companies/{insuranceCompany}/sales', 'InsuranceComapnyController@sales')->name('insurance_companies.sales');
        Route::get('/insurance_companies/{insuranceCompany}/contributions/edit', 'InsuranceComapnyController@contributionsEdit')->name('insurance_companies.contributions.edit');
        Route::post('/insurance_companies/{insuranceCompany}/contributions/update', 'InsuranceComapnyController@contributionsUpdate')->name('insurance_companies.contributions.update');
    });

    // Suppliers
    Route::get('/suppliers', 'SupplierController@index')->name('suppliers.index');
    Route::get('/suppliers/{supplier}', 'SupplierController@show')->name('suppliers.show');

    // Reservations
    Route::get('/reservations/create', 'ReservationController@create')->name('reservations.create');
    Route::post('/reservations/store', 'ReservationController@store')->name('reservations.store');

    // Users
    Route::middleware('role:superior')->group(function () {
        Route::get('/users', 'UserController@index')->name('users.index');
        Route::get('/users/create', 'UserController@create')->name('users.create');
        Route::post('/users/create', 'UserController@store')->name('users.store');
        Route::get('/users/{user}/login', 'UserController@login')->name('users.login')->middleware('role:admin');
        Route::get('/users/{user}/edit', 'UserController@edit')->name('users.edit');
        Route::post('/users/{user}/update', 'UserController@update')->name('users.update');
    });
});


