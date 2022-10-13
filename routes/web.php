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

Route::get('/admin_resident_analytics', 'Barangay_controller@admin_resident_analytics')->name('admin_resident_analytics');
Route::post('/admin_search_father', 'Barangay_controller@admin_search_father')->name('admin_search_father');
Route::post('/admin_search_mother', 'Barangay_controller@admin_search_mother')->name('admin_search_mother');

Route::get('/show_father_data/{father_id}', 'Barangay_controller@show_father_data')->name('show_father_data');


Route::post('/admin_registration_residents_generate_number_of_childrens', 'Barangay_controller@admin_registration_residents_generate_number_of_childrens')->name('admin_registration_residents_generate_number_of_childrens');

Route::post('/admin_register_residents_process', 'Barangay_controller@admin_register_residents_process')->name('admin_register_residents_process');

Route::get('/admin_resident_list', 'Barangay_controller@admin_resident_list')->name('admin_resident_list');
Route::get('/admin_resident_show_map/{id}', 'Barangay_controller@admin_resident_show_map')->name('admin_resident_show_map');

Route::get('/admin_add_complain_type', 'Barangay_controller@admin_add_complain_type')->name('admin_add_complain_type');

Route::post('/admin_complain_type_process', 'Barangay_controller@admin_complain_type_process')->name('admin_complain_type_process');
Route::post('/complain_type_edit/', 'Barangay_controller@complain_type_edit')->name('complain_type_edit');

Route::get('/complain', 'Barangay_controller@complain')->name('complain');


Route::get('/about', function () {
    return view('about');
})->name('about');
