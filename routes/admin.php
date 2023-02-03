<?php

use App\Http\Controllers\Admin\CompanyController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['guest:admin']], function () {
    Route::get('/login', 'AuthController@viewLogin')->name('login.view');
    Route::post('/login', 'AuthController@login')->name('login');
});

Route::group(['middleware' => ['auth:admin']], function () {

    // logout
    Route::post('admin-logout', 'AuthController@adminLogout')->name('admin.logout');

    // home
    Route::get('/', 'HomeController@index');
    Route::get('home', 'HomeController@index');

    //clients
    Route::resource('clients', 'ClientController');

    //laywers
    Route::resource('laywers', 'LaywerController');

    //articles
    Route::resource('articles', 'ArticleController');

    //colsults
    Route::resource('consults', 'ConsultController');

    //join-requests
    Route::get('download-pdf/{id}', 'JoinRequestController@downloadPDF')->name('download-pdf');
    Route::resource('join-requests', 'JoinRequestController');

    //contacts
    Route::resource('contacts', 'ContactController');

    //contacts
    Route::resource('services', 'ServiceController');

    // logs
    Route::resource('logs', 'LogController');

    // settings
    Route::get('settings/{lang}', 'SettingController@index')->name('settings.index');
    Route::put('settings/{lang}', 'SettingController@update')->name('settings.update');
    Route::put('settings/{lang}', 'SettingController@update')->name('settings.update');

    // policis
    Route::resource('policies','PolicyController');

    // users
    Route::get('update-profile', 'UserController@updateProfileView');
    Route::post('update-profile', 'UserController@updateProfile');
    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');

    // backups
    Route::get('backup', 'BackupController@index')->name('backup.index');
    Route::post('download', 'BackupController@download')->name('db-download');
    Route::post('upload', 'BackupController@upload')->name('db-upload');

    //company
    Route::get('companies', [CompanyController::class, 'index']);
    Route::get('companies-clients/{id}', [CompanyController::class, 'clients'])->name('company.clients');
    Route::get('companies-categories/{id}', [CompanyController::class, 'categories'])->name('company.categories');
});
