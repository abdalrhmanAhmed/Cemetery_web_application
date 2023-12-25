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
    Route::get('historical_grave', [App\Http\Controllers\api\QuoteController::class, 'historical_graves']);
    Route::get('contact', [App\Http\Controllers\api\QuoteController::class, 'contacts']);
});
