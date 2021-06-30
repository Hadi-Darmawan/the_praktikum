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
    return view('welcome');
});



// Authenticate Route

    // Login
    Route::get('login', 'Auth\LoginController@loginForm')->name('Login Form');
    Route::post('login', 'Auth\LoginController@login')->name('Login');

    // Profile Route
    Route::get('profile', 'Auth\ProfileController@profile')->name('Profile');
    Route::post('profile/update/account/{detailLogin}', 'Auth\ProfileController@updateAccount')->name('Update Profile');
    Route::post('profile/update/password/{login}', 'Auth\ProfileController@changePassword')->name('Change Password');

// End Route



// Dashboard Route
Route::get('dashboard', 'Dashboard\DashboardController@dashboard')->name('Dashboard');



// Account Management Route

    // All Account
    Route::get('account/all-data', 'AccountManagement\AccountController@accountData')->name('Account Data');

    // Edit Account
    Route::get('account/edit/{login}', 'AccountManagement\AccountController@editAccount')->name('Edit Account');
    Route::post('account/update/{login}', 'AccountManagement\AccountController@updateAccount')->name('Update Account');
    Route::post('account/disable/{id}', 'AccountManagement\AccountController@accountStatus')->name('Account Status');

    // Add Account
    Route::get('account/new', 'AccountManagement\AccountController@addAccount')->name('Add Account');
    Route::post('account/save', 'AccountManagement\AccountController@storeAccount')->name('Save Account');

    // Roles
    Route::get('roles/all-data', 'AccountManagement\RolesController@roleJabatanData')->name('Roles Data');
    Route::get('roles/edit/{login}', 'AccountManagement\RolesController@editAccountRoles')->name('Edit Account Roles');
    Route::post('roles/update/{login}', 'AccountManagement\RolesController@updateAccountRoles')->name('Update Account Roles');

// End Route