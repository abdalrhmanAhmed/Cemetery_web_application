<?php

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

// start user routes
Route::post('login',[App\Http\Controllers\api\auth\LoginController::class,'login']);

Route::prefix('user')->group(function()
{
    Route::get('get-user', [App\Http\Controllers\api\new\UserController::class, 'get_user']);
});


// start Libarary routes
Route::prefix('libarary')->group(function()
{
    Route::post('get-libarares', [App\Http\Controllers\api\new\LibararyController::class, 'get_libarares']);
    Route::get('get-libarary/{id}/{type}', [App\Http\Controllers\api\new\LibararyController::class, 'get_libarary']);
});

// start Libarary routes
Route::prefix('cemetery_sites')->group(function()
{
    Route::post('get-cemetery-sites', [App\Http\Controllers\api\new\CemeterySiteController::class, 'get_cemetery_sites']);
    Route::get('get_cemetery_detail/{id}', [App\Http\Controllers\api\new\CemeterySiteController::class, 'get_cemetery_detail']);
    Route::get('get-cemetery-site/{id}/{type}', [App\Http\Controllers\api\new\CemeterySiteController::class, 'get_cemetery_site']);
    Route::get('get-cemetery-site-contact/{id}', [App\Http\Controllers\api\new\CemeterySiteController::class, 'get_cemetery_site_contact']);
    Route::get('get_grave/{id}', [App\Http\Controllers\api\new\CemeterySiteController::class, 'get_grave']);


    // excel
    Route::get('records', [App\Http\Controllers\api\new\CemeterySiteController::class, 'index']);
    Route::get('records/search', [App\Http\Controllers\api\new\CemeterySiteController::class, 'search']);
});

// start Setting routes
Route::prefix('setting')->group(function()
{
    Route::get('get-lsetting/{key}', [App\Http\Controllers\api\new\SettingController::class, 'get_setting']);
});


Route::prefix('graves')->group(function()
{
    Route::get('get-all-grave/{id}', [App\Http\Controllers\api\CemeteryController::class, 'get_all_grave']);
    Route::get('get-graves', [App\Http\Controllers\api\CemeteryController::class, 'get_graves']);
    Route::get('get-grave-details/{id}', [App\Http\Controllers\api\CemeteryController::class, 'get_grave_details']);
});


// LibararyFinalController
Route::prefix('news')->group(function()
{
    Route::post('get-news', [App\Http\Controllers\api\new\LibararyFinalController::class, 'get_News']);
    Route::get('get-news/{id}/{type}', [App\Http\Controllers\api\new\LibararyFinalController::class, 'getNewsDetails']);
});

Route::prefix('Project')->group(function()
{
    Route::post('get-Project', [App\Http\Controllers\api\new\LibararyFinalController::class, 'get_Project']);
    Route::get('get-Project/{id}/{type}', [App\Http\Controllers\api\new\LibararyFinalController::class, 'getProjectDetails']);
});

Route::prefix('AboutTheOfficeOfCemeteriesAffair')->group(function()
{
    Route::post('get-AboutTheOfficeOfCemeteriesAffair', [App\Http\Controllers\api\new\LibararyFinalController::class, 'getAboutTheOfficeOfCemeteriesAffair']);
    Route::get('get-AboutTheOfficeOfCemeteriesAffair/{id}/{type}', [App\Http\Controllers\api\new\LibararyFinalController::class, 'getAboutTheOfficeOfCemeteriesAffairDetails']);
});


Route::prefix('getDailyDeath')->group(function()
{
    Route::post('get-getDailyDeath', [App\Http\Controllers\api\new\LibararyFinalController::class, 'getDailyDeath']);
});

