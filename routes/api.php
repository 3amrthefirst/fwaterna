<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\CompanyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('register' , [CompanyController::class , 'register']);
Route::post('login' , [CompanyController::class , 'login']);

Route::group(['middleware' => 'auth:api'] , function (){
   Route::get('user' ,[CompanyController::class , 'index']);
   Route::post('logout' ,[CompanyController::class , 'logout']);

   Route::group(['prefix' => 'category'] , function (){
       Route::get('all' , [CategoryController::class , 'index']);
       Route::post('store' , [CategoryController::class , 'store']);
   });

   Route::group(['prefix' => 'client'] , function (){
       Route::get('all' , [ClientController::class , 'index']);
       Route::post('store' , [ClientController::class , 'store']);
   });

    Route::group(['prefix' => 'subscription'] , function (){
        Route::get('/' , [CompanyController::class , 'subscription']);
        Route::post('/make' , [CompanyController::class , 'makeSubscription']);
    });

});

