<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
// controllers
use App\Http\Controllers\settings\CountryController;
use App\Http\Controllers\settings\CityController;
use App\Http\Controllers\settings\HospitalController;
use App\Http\Controllers\settings\GanderController;
use App\Http\Controllers\settings\GenealogyController;
use App\Http\Controllers\settings\ReligionController;
use App\Http\Controllers\settings\NationalityController;
use App\Http\Controllers\settings\CemeteryController;
use App\Http\Controllers\posts\QuoteController;
use App\Http\Controllers\posts\TeachingController;
use App\Http\Controllers\posts\HistoricalGraveController;
use App\Http\Controllers\posts\ProcedureController;
use App\Http\Controllers\posts\ContactController;


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
    return view('auth.login');
});

Auth::routes(['register' => false]);

// Route::get('/{page}', [App\Http\Controllers\AdminController::class , 'index']);



Route::middleware([
    'auth'
    ])->group(function()
    {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        
        ############################Settings routes###############################
        // 
        Route::resource('country', CountryController::class);
        Route::resource('city', CityController::class);
        Route::resource('hospital', HospitalController::class);
        Route::resource('gander', GanderController::class);

        Route::resource('gnealogy', GenealogyController::class);
        Route::resource('religion', ReligionController::class);
        Route::resource('nationality', NationalityController::class);
        Route::resource('cemetery', CemeteryController::class);
        // Route::resource('gander', GanderController::class);
        // Route::resource('gander', GanderController::class);
        //ajax route
        Route::get('getCity/{id}', [CemeteryController::class, 'getCity'])->name('getCity');

        ############################posts routes###############################
        // 
        Route::resource('quote', QuoteController::class);
        Route::resource('teaching', TeachingController::class);
        Route::resource('historical_grave', HistoricalGraveController::class);
        Route::resource('procedure', ProcedureController::class);
        Route::resource('contact', ContactController::class);
    }
);