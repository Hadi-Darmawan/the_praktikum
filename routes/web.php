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
    return redirect()->route('Dashboard');
});



// Authenticate Route

    // Login & Logout
    Route::get('login', 'Auth\LoginController@loginForm')->name('Login Form')->middleware('guest');
    Route::post('login', 'Auth\LoginController@login')->name('Login')->middleware('guest');
    Route::post('logout', 'Auth\LoginController@logout')->name('Logout');

    // Profile Route
    Route::get('profile', 'Auth\ProfileController@profile')->name('Profile');
    Route::post('profile/update/account/{detailLogin}', 'Auth\ProfileController@updateAccount')->name('Update Profile');
    Route::post('profile/update/password/{login}', 'Auth\ProfileController@changePassword')->name('Change Password');

// End Route



// Dashboard Route
Route::get('dashboard', 'Dashboard\DashboardController@dashboard')->name('Dashboard');



// Account Management Route

    Route::group(['middleware' => 'roles:Administrator'], function(){
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
    });

// End Route



// Additional Data Route

    // Lecture Data
    Route::get('additional-data/all-lecture', 'AdditionalData\LectureController@allLecture')->name('All Lecture')->middleware('roles:Administrator|Ketua Praktikum|Asisten Praktikum|Anggota Praktikum');
    Route::group(['middleware' => 'roles:Administrator'], function(){
        Route::post('additional-data/update-lecture/status/{id}', 'AdditionalData\LectureController@updateStatusLecture')->name('Update Status Lecture');
        Route::get('additional-data/add-lecture', 'AdditionalData\LectureController@addLecture')->name('Add Lecture');
        Route::post('additional-data/save-lecture', 'AdditionalData\LectureController@storeLecture')->name('Save Lecture');
        Route::get('additional-data/edit-lecture/{dosen}', 'AdditionalData\LectureController@editLecture')->name('Edit Lecture');
        Route::post('additional-data/update-lecture/{dosen}', 'AdditionalData\LectureController@updateLecture')->name('Update Lecture');
    });

    Route::group(['middleware' => 'roles:Administrator|Ketua Praktikum|Asisten Praktikum|Anggota Praktikum'], function(){
        // Asisten Praktikum Data
        Route::get('additional-data/asisten-praktikum/all-asisten', 'AdditionalData\AsistenPraktikumController@allAsisten')->name('All Asisten Praktikum');
        
        // Peserta Praktikum Data
        Route::get('additional-data/peserta-praktikum/all-peserta', 'AdditionalData\PesertaPraktikumController@allPeserta')->name('All Peserta Praktikum');
    });

    // Jenis Praktikum Data
    Route::group(['middleware' => 'roles:Administrator'], function(){
        Route::get('additional-data/jenis-praktikum', 'AdditionalData\JenisPraktikumController@jenisPraktikum')->name('Jenis Praktikum');
        Route::post('additional-data/save-jenis-praktikum', 'AdditionalData\JenisPraktikumController@storeJenisPraktikum')->name('Save Jenis Praktikum');
        Route::post('additional-data/delete-jenis-praktikum/{id}', 'AdditionalData\JenisPraktikumController@deleteJenisPraktikum')->name('Delete Jenis Praktikum');
    });

// End Route



// Praktikum Route

    // Routes for read & create praktikum
    Route::get('praktikum/all-praktikum', 'Praktikum\PraktikumController@allPraktikum')->name('All Praktikum')->middleware('roles:Administrator|Ketua Praktikum');

    Route::group(['middleware' => 'roles:Administrator'], function(){
        // Routes for read & create praktikum
        Route::get('praktikum/add-praktikum', 'Praktikum\PraktikumController@addPraktikum')->name('Add Praktikum');
        Route::post('praktikum/save-praktikum', 'Praktikum\PraktikumController@storePraktikum')->name('Save Praktikum');

        // Routes for edit praktikum data
        Route::get('praktikum/edit-praktikum/{praktikum}', 'Praktikum\PraktikumController@editPraktikum')->name('Edit Praktikum');
        Route::post('praktikum/update-praktikum/{praktikum}', 'Praktikum\PraktikumController@updatePraktikum')->name('Update Praktikum');
    });

    Route::group(['middleware' => 'roles:Ketua Praktikum'], function(){
        // Route for praktikum detail
        Route::get('praktikum/detail/{praktikum}', 'Praktikum\PraktikumController@detailPraktikum')->name('Detail Praktikum');
    
        // Routes for add & delete asisten praktikum
        Route::post('praktikum/edit-praktikum/add-asisten/{praktikum}', 'Praktikum\AsistenPraktikumController@storeAsistenPraktikum')->name('Add Asisten Praktikum');
        Route::post('praktikum/edit-praktikum/delete-asisten/{id}', 'Praktikum\AsistenPraktikumController@deleteAsistenPraktikum')->name('Delete Asisten Praktikum');
    
        // Routes for add & delete peserta praktikum
        Route::post('praktikum/edit-praktikum/add-praktikan/{praktikum}', 'Praktikum\AnggotaPraktikumController@storeAnggotaPraktikum')->name('Add Anggota Praktikum');
        Route::post('praktikum/edit-praktikum/delete-praktikan/{id}', 'Praktikum\AnggotaPraktikumController@deleteAnggotaPraktikum')->name('Delete Anggota Praktikum');
    
        // Routes for upload & download praktikum modul
        Route::post('praktikum/edit-praktikum/upload-modul/{praktikum}', 'Praktikum\ModulPraktikumController@uploadModul')->name('Upload Modul Praktikum');
        Route::get('praktikum/download-modul/{id}', 'Praktikum\ModulPraktikumController@downloadModul')->name('Download Modul Praktikum');
    });

// End Route



// Data Penilaian Route

    Route::group(['middleware' => 'roles:Ketua Praktikum'], function(){
        Route::get('praktikum/data-penilaian', 'Praktikum\DataPenilaianController@dataPenilaian')->name('All Data Penilaian');
        Route::post('praktikum/data-penilaian/add-penilaian', 'Praktikum\DataPenilaianController@storePenilaian')->name('Add Data Penilaian');
        Route::post('praktikum/data-penilaian/delete-penilaian/{id}', 'Praktikum\DataPenilaianController@deletePenilaian')->name('Delete Penilaian');
    });

// End Route



// Penilaian Route

    Route::group(['middleware' => 'roles:Ketua Praktikum|Asisten Praktikum'], function(){
        Route::get('praktikum/penilaian', 'Praktikum\PenilaianController@allPenilaian')->name('All Penilaian');
        Route::get('praktikum/penilaian/{praktikum}', 'Praktikum\PenilaianController@detailPenilaian')->name('Detail Penilaian');
        Route::post('praktikum/penilaian/add-penilaian/{praktikum}', 'Praktikum\PenilaianController@addPenilaian')->name('Add Penilaian');
    });

// End Route



// Nilai Route

    Route::group(['middleware' => 'roles:Anggota Praktikum'], function(){
        Route::get('praktikum/nilai', 'Praktikum\NilaiController@allPenilaian')->name('All Nilai');
        Route::get('praktikum/nilai/detail/{praktikum}', 'Praktikum\NilaiController@detailNilai')->name('Detail Nilai');
    });

// End Route