<?php

// eval(testserviceProvider('Deployer'));
use laravelLara\lskuhrm\Http\Controllers\DataController;
use laravelLara\lskuhrm\Http\Controllers\EnvironmentController;
use laravelLara\lskuhrm\Http\Controllers\AccessController;
use laravelLara\lskuhrm\Http\Controllers\RequirementsController;
use laravelLara\lskuhrm\Http\Controllers\UpdateController;
use laravelLara\lskuhrm\Http\Controllers\WelcomeController;

Route::group(['namespace' => 'Installer', 'prefix' => 'install', 'as' => 'SprukoAppInstaller::', 'middleware' => ['web', 'installability']], function () {

    Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
    Route::get('requirement', [RequirementsController::class, 'index'])->name('requirement');
    Route::get('permissions', [AccessController::class, 'index'])->name('permissions');
    Route::get('environment', [EnvironmentController::class, 'index'])->name('environment');
    Route::post('/environment/Wizardsave', [EnvironmentController::class, 'installapp'])->name('environmentSaveWizard');
    Route::get('database', [DataController::class, 'index'])->name('database');
    Route::get('importsql', [EnvironmentController::class, 'importsql'])->name('importsql');
    Route::get('chooseenvironment', [EnvironmentController::class, 'chooseenvironment'])->name('chooseenvironment');
    Route::get('processing', [EnvironmentController::class, 'processing'])->name('processing');
    Route::post('database/sqlimport', [EnvironmentController::class, 'sqlimport'])->name('database.sqlimport');

    Route::get('addnewpurchasecode', [EnvironmentController::class, 'addnewpurchasecode'])->name('addnewpurchasecode');
    Route::post('verifypurchasecode', [EnvironmentController::class, 'verifypurchasecode'])->name('verifypurchasecode');

});

Route::group(['namespace' => 'Installer', 'prefix' => 'update', 'middleware' => 'web', 'as' => 'SprukoUpdater::'], function () {

    Route::group(['middleware' => 'canupdate'], function () {
        Route::get('/', [UpdateController::class, 'index'])->name('welcome');
        Route::get('overview', [UpdateController::class, 'overview'])->name('overview');
        Route::get('database', [UpdateController::class, 'database'])->name('database');
    });

    // This needs to be out of the middleware because right after the migration has been
    // run, the middleware sends a 404.
    Route::get('final', [UpdateController::class, 'finish'])->name('final');

});
