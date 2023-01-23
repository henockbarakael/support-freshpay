<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PayDrcTransactionController;
use App\Http\Controllers\SwitchTransactionController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransactionReportController;
use App\Http\Controllers\UpdateTransactionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\DataTables\datatables;
use App\Http\Controllers\API\FreshPayAPIController;
use App\Http\Controllers\API\ManagerAPIController;
use App\Http\Controllers\API\SendCallBackToMerchant;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DateRangeController;
use App\Http\Controllers\ProfilController;

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
Auth::routes();

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.post'); 
Route::get('registration', [RegisterController::class, 'registration'])->name('register');
Route::post('registration', [RegisterController::class, 'create'])->name('register.post');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['prefix'=>'admin','middleware' => ['auth','is_admin','prevent-back-history']], function () {
    # Dashboard Overview
    Route::get('dashboard', [HomeController::class, 'admin'])->name('admin.dashboard');
    Route::get('merchants/statistiques', [HomeController::class, 'merchantStatistiques'])->name('merchant.statistiques');
    # Callback
    Route::get('callback_url', [SendCallBackToMerchant::class, 'merchant_callback_url'])->name('admin.merchant_callback_url');
    Route::get('send-callback', [TransactionController::class, 'callbackRequest'])->name('admin.callbackrequest');
    Route::post('send-callback', [TransactionController::class, 'sendCallback'])->name('admin.sendcallback');
    # Update Transaction
    Route::get('transaction/update-single', [UpdateTransactionController::class, 'update'])->name('admin.update');
    Route::post('transaction/update-single', [UpdateTransactionController::class, 'updateSearch'])->name('admin.update.search');
    // Route::post('transaction/update-single', [UpdateTransactionController::class, 'updatePost'])->name('admin.update.post');
    Route::get('transaction/bulkupdate', [UpdateTransactionController::class, 'bulkupdate'])->name('admin.bulkupdate');
    Route::post('transaction/bulkupdate', [UpdateTransactionController::class, 'bulkupdatePost'])->name('admin.bulkupdate.post');
    # PayDrc Transaction
    Route::get('paydrc/charge/overview', [PayDrcTransactionController::class, 'charge'])->name('admin.paydrc.charge');
    Route::get('paydrc/payout/overview', [PayDrcTransactionController::class, 'payout'])->name('admin.paydrc.payout');
    # Switch Transaction
    Route::get('switch/charge/overview', [SwitchTransactionController::class, 'charge'])->name('admin.switch.charge');
    Route::get('switch/payout/overview', [SwitchTransactionController::class, 'payout'])->name('admin.switch.payout');
    # Transaction Report
    Route::get('transaction/report/last-week', [TransactionReportController::class, 'LastWeek'])->name('admin.report.week');
    Route::get('transaction/report/last-week', [TransactionReportController::class, 'LastWeek'])->name('admin.report.week');
    Route::get('transaction/report/last-month', [TransactionReportController::class, 'LastMonth'])->name('admin.report.month');
    Route::get('transaction/report/daterangepicker', [TransactionReportController::class, 'DateRangePicker'])->name('admin.report.daterange');
    # Import
    Route::get('import-file', [TransactionController::class, 'import'])->name('admin.import');
    Route::get('import-merchant-file', [TransactionController::class, 'merchantFile'])->name('admin.merchant.import');
    Route::post('import-merchant-file', [TransactionController::class, 'uploadMerchantFile'])->name('admin.upload.merchant.file');
    Route::post('import-file', [TransactionController::class, 'upload'])->name('admin.upload');
    # 
    Route::post('update-all', [TransactionController::class, 'updateAll'])->name('admin.updateAll');
    Route::get('update-selected', [TransactionController::class, 'updateSelected'])->name('admin.updateSelected');
    #
    Route::get('profil', [ProfilController::class, 'index'])->name('admin.profil');
    Route::get('edit-profil', [ProfilController::class, 'edit'])->name('admin.profil.edit');
    Route::put('edit-profil', [ProfilController::class, 'update'])->name('admin.profil.update');
    
    #
    // Route::get('import-file-verify', [FreshPayAPIController::class, 'verify'])->name('admin.import.verify');
    Route::post('verify-select-ids', [FreshPayAPIController::class, 'VerifyIds'])->name('admin.verifyids');
    Route::post('action-failed-all', [TransactionController::class, 'FailedIds'])->name('admin.failedids');
    Route::post('action-successfull-all', [TransactionController::class, 'SuccessfulIds'])->name('admin.successids');

    Route::delete('delete-multiple', [TransactionController::class, 'deleteMultiple'])->name('admin.transaction.delete.multiple');
    #
    Route::post('success-single/{id}', [TransactionController::class, 'SuccessSingle'])->name('admin.success.single');
    Route::post('failed-single/{id}', [TransactionController::class, 'FailedSingle'])->name('admin.failed.single');
    Route::get('update-result', [TransactionController::class, 'updateResult'])->name('admin.updateResult');
    # API
    Route::get('paydrc/test/payment-request', [FreshPayAPIController::class, 'PaymentRequest'])->name('admin.api.test');
    Route::post('paydrc/test/payment-request', [FreshPayAPIController::class, 'PostRequest'])->name('admin.api.post.request');
    Route::get('paydrc/transaction/verify', [FreshPayAPIController::class, 'verify'])->name('admin.transaction.verify');
    Route::resource('/paydrc/transaction/verify/search', FreshPayAPIController::class);
    Route::post('/paydrc/transaction/verify/search/process', [FreshPayAPIController::class,'verifySearch'])->name('admin.verify.search');
    Route::post('paydrc/transaction/verify/upload', [FreshPayAPIController::class, 'uploadVerify'])->name('admin.transaction.verify.upload');
    // Route::post('paydrc/transaction/verify', [FreshPayAPIController::class, 'verifyTransaction'])->name('admin.transaction.verify.request');

});

Route::group(['prefix'=>'manager','middleware' => ['auth','is_manager','prevent-back-history']], function () {
    Route::get('dashboard', [HomeController::class, 'manager'])->name('manager.dashboard');
    Route::get('statistiques', [HomeController::class, 'merchantStatistiques'])->name('manager.statistiques');
    # PayDrc Transaction
    Route::get('paydrc/charge/overview', [PayDrcTransactionController::class, 'charge'])->name('manager.paydrc.charge');
    Route::get('paydrc/payout/overview', [PayDrcTransactionController::class, 'payout'])->name('manager.paydrc.payout');
    # Switch Transaction
    Route::get('switch/charge/overview', [SwitchTransactionController::class, 'charge'])->name('manager.switch.charge');
    Route::get('switch/payout/overview', [SwitchTransactionController::class, 'payout'])->name('manager.switch.payout');
    # Transaction Report
    Route::get('transaction/report/last-week', [TransactionReportController::class, 'LastWeek'])->name('manager.report.week');
    Route::get('transaction/report/last-week', [TransactionReportController::class, 'LastWeek'])->name('manager.report.week');
    Route::get('transaction/report/last-month', [TransactionReportController::class, 'LastMonth'])->name('manager.report.month');
    Route::get('transaction/report/daterangepicker', [TransactionReportController::class, 'DateRangePicker'])->name('manager.report.daterange');
    # Callback
    Route::get('callback_url', [SendCallBackToMerchant::class, 'merchant_callback_url'])->name('manager.merchant_callback_url');
    Route::get('send-callback', [TransactionController::class, 'callbackRequest'])->name('manager.callbackrequest');
    Route::post('send-callback', [TransactionController::class, 'sendCallback'])->name('manager.sendcallback');
    # API
    Route::get('paydrc/test/payment-request', [FreshPayAPIController::class, 'PaymentRequest'])->name('manager.api.test');
    Route::post('paydrc/test/payment-request', [FreshPayAPIController::class, 'PostRequest'])->name('manager.api.post.request');
    Route::get('paydrc/transaction/verify', [ManagerAPIController::class, 'verify'])->name('manager.transaction.verify');
    Route::resource('/paydrc/transaction/verify-transaction', ManagerAPIController::class);
    Route::post('/paydrc/transaction/verify/search/process', [ManagerAPIController::class,'verifySearch'])->name('manager.verify.search');
    Route::post('paydrc/transaction/verify/upload', [ManagerAPIController::class, 'uploadVerify'])->name('manager.transaction.verify.upload');

    # Import
    Route::get('import-file', [TransactionController::class, 'import'])->name('manager.import');
    Route::get('import-merchant-file', [TransactionController::class, 'merchantFile'])->name('manager.merchant.import');
    Route::post('import-merchant-file', [TransactionController::class, 'uploadMerchantFile'])->name('manager.upload.merchant.file');
    Route::post('import-file', [TransactionController::class, 'upload'])->name('manager.upload');
    # 
    Route::post('update-all', [TransactionController::class, 'updateAll'])->name('manager.updateAll');
    Route::get('update-selected', [TransactionController::class, 'updateSelected'])->name('manager.updateSelected');
    #
    Route::get('profil', [ProfilController::class, 'index'])->name('manager.profil');
    Route::get('edit-profil', [ProfilController::class, 'edit'])->name('manager.profil.edit');
    Route::put('edit-profil', [ProfilController::class, 'update'])->name('manager.profil.update');
    
    #
    // Route::get('import-file-verify', [FreshPayAPIController::class, 'verify'])->name('manager.import.verify');
    Route::post('verify-select-ids', [FreshPayAPIController::class, 'VerifyIds'])->name('manager.verifyids');
    Route::post('action-failed-all', [TransactionController::class, 'FailedIds'])->name('manager.failedids');
    Route::post('action-successfull-all', [TransactionController::class, 'SuccessfulIds'])->name('manager.successids');
    
    Route::delete('delete-multiple', [TransactionController::class, 'deleteMultiple'])->name('manager.transaction.delete.multiple');
    #
    Route::post('success-single/{id}', [TransactionController::class, 'SuccessSingle'])->name('manager.success.single');
    Route::post('failed-single/{id}', [TransactionController::class, 'FailedSingle'])->name('manager.failed.single');
    Route::get('update-result', [TransactionController::class, 'updateResult'])->name('manager.updateResult');

    # Update Transaction
    Route::get('transaction/update-single', [UpdateTransactionController::class, 'update'])->name('manager.update');
    Route::post('transaction/update-single', [UpdateTransactionController::class, 'updateSearch'])->name('manager.update.search');
    // Route::post('transaction/update-single', [UpdateTransactionController::class, 'updatePost'])->name('manager.update.post');
    Route::get('transaction/bulkupdate', [UpdateTransactionController::class, 'bulkupdate'])->name('manager.bulkupdate');
    Route::post('transaction/bulkupdate', [UpdateTransactionController::class, 'bulkupdatePost'])->name('manager.bulkupdate.post');
});

Route::group(['middleware' => ['auth','is_finance','prevent-back-history']], function () {
    Route::get('finance/dashboard', [HomeController::class, 'finance'])->name('finance.dashboard');
});
Route::group(['middleware' => ['auth','is_supportone','prevent-back-history']], function () {
    Route::get('support/dashboard', [HomeController::class, 'support_1'])->name('support_1.dashboard');
});
Route::group(['middleware' => ['auth','is_supporttwo','prevent-back-history']], function () {
    Route::get('support/dashboard', [HomeController::class, 'support_2'])->name('support_2.dashboard');
});
Route::group(['middleware' => ['auth','is_supportthree','prevent-back-history']], function () {
    Route::get('support/dashboard', [HomeController::class, 'support_3'])->name('support_3.dashboard');
});


Route::middleware('auth')->group(function () {
    // Account pages
    Route::prefix('account')->group(function () {
        Route::get('settings', [ProfilController::class, 'index'])->name('settings.index');
        Route::get('settings/edit', [ProfilController::class, 'edit'])->name('settings.edit');
        Route::put('settings/edit', [ProfilController::class, 'update'])->name('settings.update');
        Route::put('settings/email', [ProfilController::class, 'changeEmail'])->name('settings.changeEmail');
        Route::put('settings/password', [ProfilController::class, 'changePassword'])->name('settings.changePassword');
    });

    // Logs pages
    // Route::prefix('log')->name('log.')->group(function () {
    //     Route::resource('system', SystemLogsController::class)->only(['index', 'destroy']);
    //     Route::resource('audit', AuditLogsController::class)->only(['index', 'destroy']);
    // });
});

