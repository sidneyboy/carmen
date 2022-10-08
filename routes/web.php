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

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::get('/admin_dashboard', 'Barangay_controller@admin_dashboard')->name('admin_dashboard');
Route::get('/admin_barangay_officials_registration', 'Barangay_controller@admin_barangay_officials_registration')->name('admin_barangay_officials_registration');
Route::post('/admin_barangay_officials_registration_process', 'Barangay_controller@admin_barangay_officials_registration_process')->name('admin_barangay_officials_registration_process');



Route::get('/admin_register_residents', 'Barangay_controller@admin_register_residents')->name('admin_register_residents');

Route::post('/admin_registration_residents_generate_number_of_childrens', 'Barangay_controller@admin_registration_residents_generate_number_of_childrens')->name('admin_registration_residents_generate_number_of_childrens');




Route::get('/about', function () {
    return view('about');
})->name('about');
