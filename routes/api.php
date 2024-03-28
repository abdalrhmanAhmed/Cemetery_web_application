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

Route::prefix('posts')->group(function(){
    Route::get('quote', [App\Http\Controllers\api\QuoteController::class, 'quotes']);
    Route::get('teaching', [App\Http\Controllers\api\QuoteController::class, 'teachings']);
    Route::get('procedure', [App\Http\Controllers\api\QuoteController::class, 'procedures']);
    Route::get('historical-grave-all', [App\Http\Controllers\api\QuoteController::class, 'historical_graves_all']);
    Route::get('historical-grave-details/{id}', [App\Http\Controllers\api\QuoteController::class, 'historical_graves_details']);
    Route::get('historical-grave-search/{name}', [App\Http\Controllers\api\QuoteController::class, 'historical_graves_search']);
    Route::get('contact', [App\Http\Controllers\api\QuoteController::class, 'contacts']);
});


Route::prefix('cemeteries')->group(function()
{
    Route::get('get-country', [App\Http\Controllers\api\CemeteryController::class, 'get_country']);
    Route::get('get-cemetery/{id}', [App\Http\Controllers\api\CemeteryController::class, 'get_cemetery']);
    Route::get('get-cemetery-details/{id}', [App\Http\Controllers\api\CemeteryController::class, 'get_cemetery_details']);
});



Route::prefix('graves')->group(function()
{
    Route::get('get-all-grave/{id}', [App\Http\Controllers\api\CemeteryController::class, 'get_all_grave']);
    Route::get('get-graves', [App\Http\Controllers\api\CemeteryController::class, 'get_graves']);
    Route::get('get-grave-details/{id}', [App\Http\Controllers\api\CemeteryController::class, 'get_grave_details']);
});
