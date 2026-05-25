<?php

// eval(testserviceProvider('Procedure'));
use Illuminate\Support\Facades\Route;
use laravelLara\lskuhrm\Http\Controllers\IndexController;

Route::group(['prefix' => 'admin', 'middleware' => ['auth:admin', 'admin.auth', 'preventback', 'checkinstallation']], function () {
    Route::get('tokenGenerate/view', [IndexController::class, 'tokenGenerateview'])->name('admin.tokenGenerate.view');
    Route::get('tokenGenerate/create', [IndexController::class, 'tokenGenerate'])->name('admin.tokenGenerate');
    Route::get('requesttoken', [IndexController::class, 'requesttoken'])->name('admin.requesttoken');
    Route::get('databasedownload', [IndexController::class, 'exportDatabase'])->name('admin.exportDatabase');
    Route::get('downloadprojectfiles', [IndexController::class, 'downloadProject'])->name('admin.downloadProject');

});
Route::get('shiftedUser', [IndexController::class, 'userShifted'])->name('admin.userShifted');
Route::group(['prefix' => 'install', 'as' => 'SprukoAppInstaller::', 'middleware' => ['installability']], function () {
    Route::get('register', [IndexController::class, 'logindetails'])->name('register');
    Route::post('register', [IndexController::class, 'logindetailsstore'])->name('registerstore');
    Route::get('final', [IndexController::class, 'index'])->name('final');
    Route::post('verifytoken', [IndexController::class, 'verifytoken'])->name('verifytoken');
    Route::get('updatefinal', [IndexController::class, 'updatefinal'])->name('updatefinal');
    Route::post('verifyUpdatetoken', [IndexController::class, 'verifyUpdatetoken'])->name('verifyUpdatetoken');
    Route::get('verifyUpdatetokenindex', [IndexController::class, 'verifyUpdatetokenindex'])->name('verifyUpdatetokenindex');
});

Route::get('detail/admin/UserInHold', [IndexController::class, 'userInHold'])->middleware('cors');
Route::get('detail/admin/usershiftedurl', [IndexController::class, 'userShifted']);
Route::get('detail/admin/validatelog', [IndexController::class, 'validatelog'])->middleware('cors');
