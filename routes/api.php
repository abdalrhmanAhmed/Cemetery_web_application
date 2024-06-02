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
    Route::post('get-libarary', [App\Http\Controllers\api\new\LibararyController::class, 'get_libarary']);
});

// start Libarary routes
Route::prefix('cemetery_sites')->group(function()
{
    Route::post('get-cemetery-sites', [App\Http\Controllers\api\new\CemeterySiteController::class, 'get_cemetery_sites']);
    Route::post('get-cemetery-site/{id}', [App\Http\Controllers\api\new\CemeterySiteController::class, 'get_cemetery_site']);
});


Route::prefix('graves')->group(function()
{
    Route::get('get-all-grave/{id}', [App\Http\Controllers\api\CemeteryController::class, 'get_all_grave']);
    Route::get('get-graves', [App\Http\Controllers\api\CemeteryController::class, 'get_graves']);
    Route::get('get-grave-details/{id}', [App\Http\Controllers\api\CemeteryController::class, 'get_grave_details']);
});
