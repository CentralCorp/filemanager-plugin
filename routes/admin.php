<?php

use Azuriom\Plugin\FileManager\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use Barryvdh\Elfinder\ElfinderController;
use Azuriom\Plugin\FileManager\Controllers\Admin\ConfigController; // Correction: ajout du point-virgule

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your plugin. These
| routes are loaded by the RouteServiceProvider of your plugin within
| a group which contains the "web" middleware group and your plugin name
| as prefix. Now create something great!
|
*/
Route::get('/', function () {
    return view('filemanager::admin.file-manager');
})->name('filemanager');

// Correction des routes vers ConfigController
Route::get('config', [ConfigController::class, 'editConfig'])->name('config');
Route::post('config', [ConfigController::class, 'updateConfig'])->name('updateConfig');


Route::prefix('elfinder')->group(function () {
    Route::get('/', [ElfinderController::class, 'showIndex'])->name('elfinder.index');
    Route::any('connector', [ElfinderController::class, 'showConnector'])->name('elfinder.connector');
    Route::get('popup/{input_id}', [ElfinderController::class, 'showPopup'])->name('elfinder.popup');
    Route::get('filepicker/{input_id}', [ElfinderController::class, 'showFilePicker'])->name('elfinder.filepicker');
    Route::get('tinymce', [ElfinderController::class, 'showTinyMCE'])->name('elfinder.tinymce');
    Route::get('tinymce4', [ElfinderController::class, 'showTinyMCE4'])->name('elfinder.tinymce4');
    Route::get('tinymce5', [ElfinderController::class, 'showTinyMCE5'])->name('elfinder.tinymce5');
    Route::get('ckeditor', [ElfinderController::class, 'showCKeditor4'])->name('elfinder.ckeditor');
});
