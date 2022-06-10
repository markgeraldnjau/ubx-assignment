<?php

use App\Http\Controllers\AddressGroupController;
use App\Http\Controllers\Administration\FinanceController;
use App\Http\Controllers\Administration\Invoice\InvoiceController;
use App\Http\Controllers\Administration\Payment\PaymentController;
use App\Http\Controllers\Administration\PriceListController;
use App\Http\Controllers\Administration\ServiceProviderController;
use App\Http\Controllers\API\CampaignController as APICampaignController;
use App\Http\Controllers\Auth\DashboardController;
use App\Http\Controllers\BulkSmsController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\ManageContactController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\UploadController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::post('/upload/excel', [UploadController::class, 'uploadExcel'])
    ->name('uploadExcel');
Route::get('/get/excel/data', [UploadController::class, 'getExcelData'])->name('getExcelData');
Route::get('/get/excel/data/api', [UploadController::class, 'getExcelDataAPI'])->name('getExcelDataAPI');

require __DIR__ . '/auth.php';
