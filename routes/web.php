<?php

use App\Http\Controllers\SheetDbController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('save-data', [SheetDbController::class, 'saveDataAllCompany']);
Route::get('save-data-manual-range-date/{companyName}/{startDate}/{endDate}', [SheetDbController::class, 'saveDataManualRangeDate']);
Route::get('save-data-manual-selected-date/{companyName}/{selectedDate}', [SheetDbController::class, 'saveDataManualSelectedDate']);

Route::get('sheet-db', [SheetDbController::class, 'get']);
Route::get('login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::get('register', [AuthController::class, 'register'])->name('register')->middleware('guest');
Route::post('post-register', [AuthController::class, 'postRegister'])->name('register.post'); 
Route::get('dashboard', [AuthController::class, 'dashboard'])->middleware('auth'); 
Route::post('logout', [AuthController::class, 'logout'])->name('logout');


Route::get('anorganic-data', [DashboardController::class, 'getDataAnorganic']);
Route::get('organic-data', [DashboardController::class, 'getDataOrganic']);
Route::get('type-waste-data', [DashboardController::class, 'getDataTypeWaste']);
Route::get('summary-data', [DashboardController::class, 'getDataSummary']);
Route::get('amount-day-data', [DashboardController::class, 'getDataAmountsWasteByDay']);
Route::get('amount-month-data', [DashboardController::class, 'getDataAmountsWasteByMonth']);