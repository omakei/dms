<?php

use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('download-label/{investigation}', [ReportController::class, 'label'])
        ->name('label.download');
Route::get('download-referral/{referral}', [ReportController::class, 'referral'])
    ->name('referral.download');
Route::get('download-prescription/{prescription}', [ReportController::class, 'prescription'])
    ->name('prescription.download');
