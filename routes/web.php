<?php

use App\Http\Controllers\blocks\BlockController;
use App\Http\Controllers\livewire\Graving\GraveLocationController;
use App\Http\Controllers\localizationController;
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
use App\Http\Controllers\settings\GraveController;
use App\Http\Controllers\uploads\ExcelShowController;
use App\Http\Controllers\uploads\ExcelUploadController;
use App\Http\Livewire\Graving\EditGrave;
use Maatwebsite\Excel\Facades\Excel;

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
    return redirect()->route('home');
});

Auth::routes(['register' => false]);

// Route::get('/{page}', [App\Http\Controllers\AdminController::class , 'index']);

//localization Routes
Route::get('locale/{lange}', [localizationController::class, 'setLang']);

Route::middleware([
    'auth',
    'localizationMiddleware'
    ])->group(function()
    {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

        ############################Settings routes###############################
        //
        Route::resource('country', CountryController::class);
        Route::resource('city', CityController::class);
        Route::resource('hospital', HospitalController::class);
        Route::resource('gander', GanderController::class);

        // Route::resource('gnealogy', GenealogyController::class);
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

        ############################ blocks routes #############################
        Route::controller(BlockController::class)->prefix('blocks')->group(function(){
            Route::get('/', 'index')->name('blocks.index');
            Route::post('/store', 'store')->name('blocks.store');
            Route::get('/edit/{id}', 'edit')->name('blocks.edit');
            Route::post('/update/{id}', 'update')->name('blocks.update');
            Route::post('/destroy/{id}', 'destroy')->name('blocks.destroy');
        });

        ############################ graves routes #############################
        Route::controller(GraveController::class)->prefix('graves')->group(function(){
            Route::get('/', 'index')->name('graves.index');
            Route::post('/destroy/{id}', 'destroy')->name('graves.destroy');
        });

        ############################# graving livewire route #############################
        Route::view('graving', 'livewire.graving.index');
        Route::get('setpLocaltion/{grave_id}/{information_id}/{edit}', [GraveLocationController::class, 'chooseLocation'])->name('setpLocaltion');
        Route::post('setpLocaltion/storeLocation/{id}', [GraveLocationController::class, 'storeLocation'])->name('setpLocaltion.storeLocation');

        ############################# uplodad excil file route #############################

        Route::controller(ExcelUploadController::class)->prefix('uploadExcel')->group(function(){
            Route::get('/', 'index')->name('uploadExcel.index');
            Route::post('/upload', 'upload')->name('uploadExcel.upload');
            Route::get('/review', 'review')->name('uploadExcel.review');
            Route::post('/confirm', 'confirm')->name('uploadExcel.confirm');
            Route::post('/cancel', 'cancel')->name('uploadExcel.cancel');
        });
        Route::controller(ExcelShowController::class)->prefix('ExcelShow')->group(function(){
            Route::get('/', 'index')->name('ExcelShow.index');
            Route::post('/upload', 'upload')->name(('ExcelShow.upload'));
            Route::get('/filtter', 'filtter')->name('ExcelShow.filtter');
            Route::post('/bulck_delete', 'bulck_delete')->name('ExcelShow.bulck_delete');
            Route::post('/delete', 'delete')->name('ExcelShow.delete');
        });
    }
);


