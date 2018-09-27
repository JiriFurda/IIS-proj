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


/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/medicine', 'MedicineController@index')->name('medicine.index');
Route::get('/medicine/{medicine}', 'MedicineController@show')->name('medicine.show');

Route::get('/branch', 'BranchController@index')->name('branch.index');
Route::get('/branch/{branch}', 'BranchController@show')->name('branch.show');;

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
