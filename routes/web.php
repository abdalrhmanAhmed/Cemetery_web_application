<?php

use App\Http\Controllers\localizationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
// controllers

use App\Http\Controllers\uploads\ExcelShowController;
use App\Http\Controllers\uploads\ExcelUploadController;

// new routs
use App\Http\Controllers\new\LibaryController;
use App\Http\Controllers\new\ReportController   ;
use App\Http\Controllers\new\CemeterySiteController;
use App\Http\Controllers\new\LibaryDetailsController;
use App\Http\Controllers\new\CemeterySiteDetailsController;
use App\Http\Controllers\new\CemeterySiteContactController;
use App\Http\Controllers\new\DailyDeathController;
use App\Http\Controllers\new\DailyDeathDetailsController;
use App\Http\Controllers\new\AboutTheOfficeOfCemeteriesAffairController;
use App\Http\Controllers\new\AboutTheOfficeOfCemeteriesAffairDetailsController;
use App\Http\Controllers\new\ProjectsController;
use App\Http\Controllers\new\ProjectsDetailsController;
use App\Http\Controllers\new\NewsController;
use App\Http\Controllers\new\NewsDetailsController;
use App\Http\Controllers\new\NotificationController;
use App\Http\Controllers\new\SettingController;
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


//localization Routes
Route::get('locale/{lange}', [localizationController::class, 'setLang']);

Route::middleware([
    'auth',
    'localizationMiddleware'
    ])->group(function()
    {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


        ############################# uplodad excil file route #############################

        Route::controller(ExcelUploadController::class)->prefix('uploadExcel')->group(function(){
            Route::get('index/{id}', 'index')->name('uploadExcel.index');
            Route::post('/upload/{id}', 'upload')->name('uploadExcel.upload');
            Route::get('/review', 'review')->name('uploadExcel.review');
            Route::post('/confirm', 'confirm')->name('uploadExcel.confirm');
            Route::post('/cancel', 'cancel')->name('uploadExcel.cancel');
            Route::get('/download-file/{file_name}', [ExcelUploadController::class, 'downloadFile'])->name('download-file');
        });
        Route::controller(ExcelShowController::class)->prefix('ExcelShow')->group(function(){
            Route::get('/', 'index')->name('ExcelShow.index');
            Route::post('/upload', 'upload')->name(('ExcelShow.upload'));
            Route::get('/filtter', 'filtter')->name('ExcelShow.filtter');
            Route::post('/bulck_delete', 'bulck_delete')->name('ExcelShow.bulck_delete');
            Route::post('/delete', 'delete')->name('ExcelShow.delete');
        });



        ############################# Libary route #############################

        Route::controller(LibaryController::class)->prefix('libary')->group(function(){
            Route::get('/', 'index')->name('index.libary');
            Route::post('/add', 'store')->name('new.libary');
            Route::get('/show/{id}', 'show')->name('show.libary');
            Route::post('/update/{id}', 'update')->name('update.libary');
            Route::get('/edit/{id}', 'edit')->name('edit.libary');
            Route::post('/delete', 'destroy')->name('libary.destroy');
        });
        Route::controller(LibaryDetailsController::class)->prefix('libary')->group(function(){
            Route::post('upload/{id}', 'upload')->name('upload.libary-details');
            Route::post('text/{id}', 'text')->name('text.libary-details');
            Route::get('delete/{id}', 'delete')->name('libary.details.delete');
        });

        ############################# Cemetery sites #############################

        Route::controller(CemeterySiteController::class)->prefix('cemetery-site')->group(function(){
            Route::get('/', 'index')->name('cemetery-site.index');
            Route::post('/store', 'store')->name('cemetery-site.store');
            Route::get('/edit/{id}', 'edit')->name('cemetery-site.edit');
            Route::post('/update/{id}', 'update')->name('cemetery-site.update');
            Route::get('/show/{id}', 'show')->name('cemetery-site.show');
            Route::post('/delete', 'destroy')->name('cemetery-site.destroy');

        });

        Route::controller(CemeterySiteDetailsController::class)->prefix('cemetery-site')->group(function(){
            Route::post('upload/{id}', 'upload')->name('upload.cemetery-site');
            Route::post('text/{id}', 'text')->name('text.cemetery-site');
            Route::get('delete/{id}', 'delete')->name('cemetery-site.delete');
        });

        Route::controller(CemeterySiteContactController::class)->prefix('cemetery_site_contact')->group(function(){
            Route::post('store/{id}', 'store')->name('contact.store');
            Route::get('delete/{id}', 'destroy')->name('contact.delete');
        });



        ############################# Media Library #############################
        
        // start dailydeath
        Route::controller(DailyDeathController::class)->prefix('DailyDeathController')->group(function(){
            Route::get('/', 'index')->name('DailyDeathController.index');
            Route::post('store', 'store')->name('DailyDeathController.store');
            Route::post('update/{id}', 'update')->name('DailyDeathController.update');
            Route::post('delete', 'destroy')->name('DailyDeathController.delete');
            Route::post('store/{id}', 'store')->name('DailyDeathController.store');
            Route::get('delete', 'destroy')->name('DailyDeathController.delete');
        });
        Route::controller(DailyDeathDetailsController::class)->prefix('DailyDeathDetailsController')->group(function(){
            Route::post('store/{id}', 'store')->name('DailyDeathDetailsController.store');
            Route::get('delete/{id}', 'destroy')->name('DailyDeathDetailsController.delete');
        });
        // end dailydeath

        // start AboutTheOfficeOfCemeteriesAffair
        Route::controller(AboutTheOfficeOfCemeteriesAffairController::class)->prefix('AboutTheOfficeOfCemeteriesAffairController')->group(function(){
            Route::get('/', 'index')->name('AboutTheOfficeOfCemeteriesAffairController.index');
            Route::post('store', 'store')->name('AboutTheOfficeOfCemeteriesAffairController.store');
            Route::get('/edit/{id}', 'edit')->name('AboutTheOfficeOfCemeteriesAffairController.edit');
            Route::post('/update/{id}', 'update')->name('AboutTheOfficeOfCemeteriesAffairController.update');
            Route::get('/show/{id}', 'show')->name('AboutTheOfficeOfCemeteriesAffairController.show');
            Route::post('delete', 'destroy')->name('AboutTheOfficeOfCemeteriesAffairController.delete');

        });
        Route::controller(AboutTheOfficeOfCemeteriesAffairDetailsController::class)->prefix('AboutTheOfficeOfCemeteriesAffairDetailsController')->group(function(){
            Route::post('upload/{id}', 'upload')->name('upload.AboutTheOfficeOfCemeteriesAffairDetailsController');
            Route::post('text/{id}', 'text')->name('text.AboutTheOfficeOfCemeteriesAffairDetailsController');
            Route::get('delete/{id}', 'delete')->name('AboutTheOfficeOfCemeteriesAffairDetailsController.delete');
        });
        // end AboutTheOfficeOfCemeteriesAffair

        // start Projects
        Route::controller(ProjectsController::class)->prefix('ProjectsController')->group(function(){
            Route::get('/', 'index')->name('ProjectsController.index');
            Route::post('store', 'store')->name('ProjectsController.store');
            Route::get('/edit/{id}', 'edit')->name('ProjectsController.edit');
            Route::post('/update/{id}', 'update')->name('ProjectsController.update');
            Route::get('/show/{id}', 'show')->name('ProjectsController.show');
            Route::post('delete', 'destroy')->name('ProjectsController.delete');

        });
        Route::controller(ProjectsDetailsController::class)->prefix('ProjectsDetailsController')->group(function(){
            Route::post('upload/{id}', 'upload')->name('upload.ProjectsDetailsController');
            Route::post('text/{id}', 'text')->name('text.ProjectsDetailsController');
            Route::get('delete/{id}', 'delete')->name('ProjectsDetailsController.delete');
        });
        // end Projects

        // start News
        Route::controller(NewsController::class)->prefix('NewsController')->group(function(){
            Route::get('/', 'index')->name('NewsController.index');
            Route::post('store', 'store')->name('NewsController.store');
            Route::get('/edit/{id}', 'edit')->name('NewsController.edit');
            Route::post('/update/{id}', 'update')->name('NewsController.update');
            Route::get('/show/{id}', 'show')->name('NewsController.show');
            Route::post('delete', 'destroy')->name('NewsController.delete');
        });
        Route::controller(NewsDetailsController::class)->prefix('NewsDetailsController')->group(function(){
            Route::post('upload/{id}', 'upload')->name('upload.NewsDetailsController');
            Route::post('text/{id}', 'text')->name('text.NewsDetailsController');
            Route::get('delete/{id}', 'delete')->name('NewsDetailsController.delete');
        });
        // end News

        ############################# Notification Routes #############################
        
        Route::controller(NotificationController::class)->prefix('notifications')->group(function(){
            Route::get('/', 'index')->name('Notification.index');
            Route::post('store', 'store')->name('Notification.store');
            Route::post('delete', 'destroy')->name('Notification.delete');
            Route::get('/edit/{id}', 'edit')->name('Notification.edit');
            Route::post('/update/{id}', 'update')->name('Notification.update');

        });

        ############################# Settings Routes #############################

        Route::controller(SettingController::class)->prefix('Setting')->group(function(){
            Route::get('/', 'index')->name('Setting.index');
            Route::post('google_key', 'store_google')->name('Setting.store_google');
            Route::post('push_notification', 'store_push_notification')->name('Setting.store_push_notification');
            Route::post('store_mail', 'store_mail')->name('Setting.store_mail');

        });


        ############################# Reports Routes #############################

        Route::controller(ReportController::class)->prefix('Report')->group(function(){
            Route::get('/', 'index')->name('Report.index');
        });
       
    }
);


