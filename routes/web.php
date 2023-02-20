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
use App\Http\Controllers\API\FinanceController;
use App\Http\Controllers\API\FreshPayAPIController;
use App\Http\Controllers\API\ImportCsvFileController;
use App\Http\Controllers\API\InstitutionController;
use App\Http\Controllers\API\ManagerAPIController;
use App\Http\Controllers\API\MerchantController;
use App\Http\Controllers\API\PaymentGatewayController;
use App\Http\Controllers\API\SearchTransactionController;
use App\Http\Controllers\API\SendCallBackToMerchant;
use App\Http\Controllers\API\StatistiqueController;
use App\Http\Controllers\API\VerifyAPIController;
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
Route::get('registration', [RegisterController::class, 'registration'])->name('registration');
Route::post('registration', [RegisterController::class, 'create'])->name('registration.post'); 
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['prefix'=>'admin','middleware' => ['auth','is_admin','prevent-back-history']], function () {
    # Register
    Route::get('registration', [RegisterController::class, 'registration'])->name('register');
    Route::post('registration', [RegisterController::class, 'store'])->name('register.store');
    # Dashboard
    Route::get('dashboard', [HomeController::class, 'admin'])->name('admin.dashboard');
    # Statistique
    Route::get('merchants/statistiques', [StatistiqueController::class, 'index'])->name('admin.statistiques');
    # Search Transaction
    Route::get('transaction/search', [SearchTransactionController::class, 'index'])->name('admin.update.create');
    Route::post('transaction/search', [SearchTransactionController::class, 'update'])->name('admin.update.process');
    # Update Transaction
    Route::post('success-single/{id}', [UpdateTransactionController::class, 'SuccessSingle'])->name('admin.success.single');
    Route::post('failed-single/{id}', [UpdateTransactionController::class, 'FailedSingle'])->name('admin.failed.single');
    Route::get('update-result', [UpdateTransactionController::class, 'updateResult'])->name('admin.updateResult');
    # BulkUpdate
    Route::get('transaction/bulkupdate/import', [ImportCsvFileController::class, 'index'])->name('admin.bulkupdate.create');
    Route::post('transaction/bulkupdate/import', [ImportCsvFileController::class, 'import'])->name('admin.bulkupdate.import');
    Route::delete('delete-multiple', [ImportCsvFileController::class, 'deleteMultiple'])->name('admin.transaction.delete.multiple');
    Route::post('action-failed-all', [TransactionController::class, 'FailedIds'])->name('admin.failedids');
    Route::post('action-successfull-all', [TransactionController::class, 'SuccessfulIds'])->name('admin.successids');
    # PayDrc Transaction
    Route::get('paydrc/transaction/history', [PayDrcTransactionController::class, 'daterangePayDrc'])->name('admin.paydrc.daterange');
    // Route::post('paydrc/transaction/history', [PayDrcTransactionController::class, 'dataPayDrc'])->name('admin.paydrc.daterange.post');

    Route::get('switch/transaction/history', [PayDrcTransactionController::class, 'daterangeSwitch'])->name('admin.switch.daterange');
    Route::post('switch/transaction/history', [PayDrcTransactionController::class, 'dataSwitch'])->name('admin.switch.daterange.post');


    Route::get('paydrc/payout/overview', [PayDrcTransactionController::class, 'payout'])->name('admin.paydrc.payout');
    # Switch Transaction
    Route::get('switch/charge/overview', [SwitchTransactionController::class, 'charge'])->name('admin.switch.charge');
    Route::get('switch/payout/overview', [SwitchTransactionController::class, 'payout'])->name('admin.switch.payout');
    # Transaction Report
    Route::get('transaction/report/last-week', [TransactionReportController::class, 'LastWeek'])->name('admin.report.week');
    Route::get('transaction/report/last-month', [TransactionReportController::class, 'LastMonth'])->name('admin.report.month');
    Route::get('transaction/report/daterangepicker', [TransactionReportController::class, 'DateRangePicker'])->name('admin.report.daterange');
    # Profil
    Route::get('profil', [ProfilController::class, 'index'])->name('admin.profil');
    Route::get('edit-profil', [ProfilController::class, 'edit'])->name('admin.profil.edit');
    Route::put('edit-profil', [ProfilController::class, 'update'])->name('admin.profil.update');
    # Payment Gateway
    Route::get('api/freshpay/payment', [PaymentGatewayController::class, 'index'])->name('admin.payment.create');
    Route::post('api/freshpay/payment', [PaymentGatewayController::class, 'process'])->name('admin.payment.process');
    # Callback
    Route::get('send-callback', [SendCallBackToMerchant::class, 'index'])->name('admin.callback.create');
    Route::post('send-callback', [SendCallBackToMerchant::class, 'process'])->name('admin.callback.process');
    # Verify
    Route::get('api/freshpay/verify', [VerifyAPIController::class, 'index'])->name('admin.verify.create');
    Route::post('verify-select-ids', [VerifyAPIController::class, 'VerifyIds'])->name('admin.verifyids');
    Route::resource('/api/freshpay/verify/search', FreshPayAPIController::class);
    Route::post('/api/freshpay/verify/search/process', [VerifyAPIController::class,'verifySearch'])->name('admin.verify.search');
    Route::post('api/freshpay/verify/upload', [VerifyAPIController::class, 'uploadVerify'])->name('admin.transaction.verify.upload');
    # Institution
    Route::get('institution', [InstitutionController::class, 'index'])->name('admin.institution.create');
    Route::post('institution', [InstitutionController::class, 'store'])->name('admin.institution.store');
    Route::get('institution-user', [InstitutionController::class, 'user'])->name('admin.institution-user.create');
    Route::post('institution-user', [InstitutionController::class, 'storeUser'])->name('admin.institution-user.store');
    # Merchant
    Route::get('merchant', [MerchantController::class, 'index'])->name('admin.merchant.create');
    Route::post('merchant', [MerchantController::class, 'store'])->name('admin.merchant.store');
    # Finance
    Route::get('pending-payout', [FinanceController::class, 'pendingPayout'])->name('admin.pending.payout.create');
    Route::post('pending-payout', [FinanceController::class, 'pendingPayoutPost'])->name('admin.pending.payout.process');
    Route::post('send-data-to-switch', [FinanceController::class, 'SendToSwitch'])->name('admin.pending.payout.send');

    Route::get('merchant-balance', [FinanceController::class, 'indexBalance'])->name('admin.merchant.balance.create');
    Route::post('merchant-balance', [FinanceController::class, 'getBalance'])->name('admin.merchant.balance.get');

    Route::get('merchant-wallet', [FinanceController::class, 'getMerchantWallet'])->name('admin.merchant.wallet');
    Route::post('merchant-wallet', [FinanceController::class, 'walletUpdate'])->name('admin.merchant.wallet.update');


    Route::get('top-up-wallet', [FinanceController::class, 'TopUpWallet'])->name('admin.wallet.topup');
    Route::post('top-up-wallet', [FinanceController::class, 'WalletTopUpRequest'])->name('admin.wallet.topup.post');

    Route::get('initiate-transfer', [FinanceController::class, 'transfer'])->name('admin.transfert');
    Route::post('initiate-transfer', [FinanceController::class, 'initiateTransfer'])->name('admin.transfert.initiate');

    Route::get('wallet-history', [FinanceController::class, 'history'])->name('admin.wallet.history');

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
    Route::get('send-callback', [TransactionController::class, 'callbackRequest'])->name('manager.callback.create');
    Route::post('send-callback', [TransactionController::class, 'sendCallback'])->name('manager.callback.process');
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

Route::group(['prefix'=>'support','middleware' => ['auth','is_support','prevent-back-history']], function () {
    # Register
    Route::get('registration', [RegisterController::class, 'registration'])->name('register');
    Route::post('registration', [RegisterController::class, 'store'])->name('register.store');
    # Dashboard
    Route::get('dashboard', [HomeController::class, 'support'])->name('support.dashboard');
    # Statistique
    Route::get('merchants/statistiques', [StatistiqueController::class, 'index'])->name('support.statistiques');
    # Search Transaction
    Route::get('transaction/search', [SearchTransactionController::class, 'index'])->name('support.update.create');
    Route::post('transaction/search', [SearchTransactionController::class, 'update'])->name('support.update.process');
    # Update Transaction
    Route::post('success-single/{id}', [UpdateTransactionController::class, 'SuccessSingle'])->name('support.success.single');
    Route::post('failed-single/{id}', [UpdateTransactionController::class, 'FailedSingle'])->name('support.failed.single');
    Route::get('update-result', [UpdateTransactionController::class, 'updateResult'])->name('support.updateResult');
    # BulkUpdate
    Route::get('transaction/bulkupdate/import', [ImportCsvFileController::class, 'index'])->name('support.bulkupdate.create');
    Route::post('transaction/bulkupdate/import', [ImportCsvFileController::class, 'import'])->name('support.bulkupdate.import');
    Route::delete('delete-multiple', [ImportCsvFileController::class, 'deleteMultiple'])->name('support.transaction.delete.multiple');
    Route::post('action-failed-all', [TransactionController::class, 'FailedIds'])->name('support.failedids');
    Route::post('action-successfull-all', [TransactionController::class, 'SuccessfulIds'])->name('support.successids');
    # PayDrc Transaction
    Route::get('paydrc/transaction/history', [PayDrcTransactionController::class, 'daterangePayDrc'])->name('support.paydrc.daterange');
    // Route::post('paydrc/transaction/history', [PayDrcTransactionController::class, 'dataPayDrc'])->name('support.paydrc.daterange.post');

    Route::get('switch/transaction/history', [PayDrcTransactionController::class, 'daterangeSwitch'])->name('support.switch.daterange');
    Route::post('switch/transaction/history', [PayDrcTransactionController::class, 'dataSwitch'])->name('support.switch.daterange.post');


    Route::get('paydrc/payout/overview', [PayDrcTransactionController::class, 'payout'])->name('support.paydrc.payout');
    # Switch Transaction
    Route::get('switch/charge/overview', [SwitchTransactionController::class, 'charge'])->name('support.switch.charge');
    Route::get('switch/payout/overview', [SwitchTransactionController::class, 'payout'])->name('support.switch.payout');
    # Transaction Report
    Route::get('transaction/report/last-week', [TransactionReportController::class, 'LastWeek'])->name('support.report.week');
    Route::get('transaction/report/last-month', [TransactionReportController::class, 'LastMonth'])->name('support.report.month');
    Route::get('transaction/report/daterangepicker', [TransactionReportController::class, 'DateRangePicker'])->name('support.report.daterange');
    # Profil
    Route::get('profil', [ProfilController::class, 'index'])->name('support.profil');
    Route::get('edit-profil', [ProfilController::class, 'edit'])->name('support.profil.edit');
    Route::put('edit-profil', [ProfilController::class, 'update'])->name('support.profil.update');
    # Payment Gateway
    Route::get('api/freshpay/payment', [PaymentGatewayController::class, 'index'])->name('support.payment.create');
    Route::post('api/freshpay/payment', [PaymentGatewayController::class, 'process'])->name('support.payment.process');
    # Callback
    Route::get('send-callback', [SendCallBackToMerchant::class, 'index'])->name('support.callback.create');
    Route::post('send-callback', [SendCallBackToMerchant::class, 'process'])->name('support.callback.process');
    # Verify
    Route::get('api/freshpay/verify', [VerifyAPIController::class, 'index'])->name('support.verify.create');
    Route::post('verify-select-ids', [VerifyAPIController::class, 'VerifyIds'])->name('support.verifyids');
    Route::resource('/api/freshpay/verify/search', FreshPayAPIController::class);
    Route::post('/api/freshpay/verify/search/process', [VerifyAPIController::class,'verifySearch'])->name('support.verify.search');
    Route::post('api/freshpay/verify/upload', [VerifyAPIController::class, 'uploadVerify'])->name('support.transaction.verify.upload');
    # Institution
    Route::get('institution', [InstitutionController::class, 'index'])->name('support.institution.create');
    Route::post('institution', [InstitutionController::class, 'store'])->name('support.institution.store');
    Route::get('institution-user', [InstitutionController::class, 'user'])->name('support.institution-user.create');
    Route::post('institution-user', [InstitutionController::class, 'storeUser'])->name('support.institution-user.store');
    # Merchant
    Route::get('merchant', [MerchantController::class, 'index'])->name('support.merchant.create');
    Route::post('merchant', [MerchantController::class, 'store'])->name('support.merchant.store');
    # Finance
    Route::get('pending-payout', [FinanceController::class, 'pendingPayout'])->name('support.pending.payout.create');
    Route::post('pending-payout', [FinanceController::class, 'pendingPayoutPost'])->name('support.pending.payout.process');

    Route::get('merchant-balance', [FinanceController::class, 'indexBalance'])->name('support.merchant.balance.create');
    Route::post('merchant-balance', [FinanceController::class, 'getBalance'])->name('support.merchant.balance.get');

    Route::get('top-up-wallet', [FinanceController::class, 'TopUpWallet'])->name('support.wallet.topup');
    Route::post('top-up-wallet', [FinanceController::class, 'WalletTopUpRequest'])->name('support.wallet.topup.post');

    Route::get('initiate-transfer', [FinanceController::class, 'transfer'])->name('support.transfert');
    Route::post('initiate-transfer', [FinanceController::class, 'initiateTransfer'])->name('support.transfert.initiate');

    Route::get('wallet-history', [FinanceController::class, 'history'])->name('support.wallet.history');
});

Route::group(['prefix'=>'finance','middleware' => ['auth','is_finance','prevent-back-history']], function () {
    # Register
    Route::get('registration', [RegisterController::class, 'registration'])->name('register');
    Route::post('registration', [RegisterController::class, 'store'])->name('register.store');
    # Dashboard
    Route::get('dashboard', [HomeController::class, 'finance'])->name('finance.dashboard');
    # Statistique
    Route::get('merchants/statistiques', [StatistiqueController::class, 'index'])->name('finance.statistiques');
    # Search Transaction
    Route::get('transaction/search', [SearchTransactionController::class, 'index'])->name('finance.update.create');
    Route::post('transaction/search', [SearchTransactionController::class, 'update'])->name('finance.update.process');
    # Update Transaction
    Route::post('success-single/{id}', [UpdateTransactionController::class, 'SuccessSingle'])->name('finance.success.single');
    Route::post('failed-single/{id}', [UpdateTransactionController::class, 'FailedSingle'])->name('finance.failed.single');
    Route::get('update-result', [UpdateTransactionController::class, 'updateResult'])->name('finance.updateResult');
    # BulkUpdate
    Route::get('transaction/bulkupdate/import', [ImportCsvFileController::class, 'index'])->name('finance.bulkupdate.create');
    Route::post('transaction/bulkupdate/import', [ImportCsvFileController::class, 'import'])->name('finance.bulkupdate.import');
    Route::delete('delete-multiple', [ImportCsvFileController::class, 'deleteMultiple'])->name('finance.transaction.delete.multiple');
    Route::post('action-failed-all', [TransactionController::class, 'FailedIds'])->name('finance.failedids');
    Route::post('action-successfull-all', [TransactionController::class, 'SuccessfulIds'])->name('finance.successids');
    # PayDrc Transaction
    Route::get('paydrc/transaction/history', [PayDrcTransactionController::class, 'daterangePayDrc'])->name('finance.paydrc.daterange');
    // Route::post('paydrc/transaction/history', [PayDrcTransactionController::class, 'dataPayDrc'])->name('finance.paydrc.daterange.post');

    Route::get('switch/transaction/history', [PayDrcTransactionController::class, 'daterangeSwitch'])->name('finance.switch.daterange');
    Route::post('switch/transaction/history', [PayDrcTransactionController::class, 'dataSwitch'])->name('finance.switch.daterange.post');


    Route::get('paydrc/payout/overview', [PayDrcTransactionController::class, 'payout'])->name('finance.paydrc.payout');
    # Switch Transaction
    Route::get('switch/charge/overview', [SwitchTransactionController::class, 'charge'])->name('finance.switch.charge');
    Route::get('switch/payout/overview', [SwitchTransactionController::class, 'payout'])->name('finance.switch.payout');
    # Transaction Report
    Route::get('transaction/report/last-week', [TransactionReportController::class, 'LastWeek'])->name('finance.report.week');
    Route::get('transaction/report/last-month', [TransactionReportController::class, 'LastMonth'])->name('finance.report.month');
    Route::get('transaction/report/daterangepicker', [TransactionReportController::class, 'DateRangePicker'])->name('finance.report.daterange');
    # Profil
    Route::get('profil', [ProfilController::class, 'index'])->name('finance.profil');
    Route::get('edit-profil', [ProfilController::class, 'edit'])->name('finance.profil.edit');
    Route::put('edit-profil', [ProfilController::class, 'update'])->name('finance.profil.update');
    # Payment Gateway
    Route::get('api/freshpay/payment', [PaymentGatewayController::class, 'index'])->name('finance.payment.create');
    Route::post('api/freshpay/payment', [PaymentGatewayController::class, 'process'])->name('finance.payment.process');
    # Callback
    Route::get('send-callback', [SendCallBackToMerchant::class, 'index'])->name('finance.callback.create');
    Route::post('send-callback', [SendCallBackToMerchant::class, 'process'])->name('finance.callback.process');
    # Verify
    Route::get('api/freshpay/verify', [VerifyAPIController::class, 'index'])->name('finance.verify.create');
    Route::post('verify-select-ids', [VerifyAPIController::class, 'VerifyIds'])->name('finance.verifyids');
    Route::resource('/api/freshpay/verify/search', FreshPayAPIController::class);
    Route::post('/api/freshpay/verify/search/process', [VerifyAPIController::class,'verifySearch'])->name('finance.verify.search');
    Route::post('api/freshpay/verify/upload', [VerifyAPIController::class, 'uploadVerify'])->name('finance.transaction.verify.upload');
    # Institution
    Route::get('institution', [InstitutionController::class, 'index'])->name('finance.institution.create');
    Route::post('institution', [InstitutionController::class, 'store'])->name('finance.institution.store');
    Route::get('institution-user', [InstitutionController::class, 'user'])->name('finance.institution-user.create');
    Route::post('institution-user', [InstitutionController::class, 'storeUser'])->name('finance.institution-user.store');
    # Merchant
    Route::get('merchant', [MerchantController::class, 'index'])->name('finance.merchant.create');
    Route::post('merchant', [MerchantController::class, 'store'])->name('finance.merchant.store');
    # Finance
    Route::get('pending-payout', [FinanceController::class, 'pendingPayout'])->name('finance.pending.payout.create');
    Route::post('pending-payout', [FinanceController::class, 'pendingPayoutPost'])->name('finance.pending.payout.process');

    Route::get('merchant-balance', [FinanceController::class, 'indexBalance'])->name('finance.merchant.balance.create');
    Route::post('merchant-balance', [FinanceController::class, 'getBalance'])->name('finance.merchant.balance.get');

    Route::get('top-up-wallet', [FinanceController::class, 'TopUpWallet'])->name('finance.wallet.topup');
    Route::post('top-up-wallet', [FinanceController::class, 'WalletTopUpRequest'])->name('finance.wallet.topup.post');

    Route::get('initiate-transfer', [FinanceController::class, 'transfer'])->name('finance.transfert');
    Route::post('initiate-transfer', [FinanceController::class, 'initiateTransfer'])->name('finance.transfert.initiate');

    Route::get('wallet-history', [FinanceController::class, 'history'])->name('finance.wallet.history');
});

Route::group(['prefix'=>'suppfin','middleware' => ['auth','is_suppfin','prevent-back-history']], function () {
    # Register
    Route::get('registration', [RegisterController::class, 'registration'])->name('register');
    Route::post('registration', [RegisterController::class, 'store'])->name('register.store');
    # Dashboard
    Route::get('dashboard', [HomeController::class, 'suppfin'])->name('suppfin.dashboard');
    # Statistique
    Route::get('merchants/statistiques', [StatistiqueController::class, 'index'])->name('suppfin.statistiques');
    # Search Transaction
    Route::get('transaction/search', [SearchTransactionController::class, 'index'])->name('suppfin.update.create');
    Route::post('transaction/search', [SearchTransactionController::class, 'update'])->name('suppfin.update.process');
    # Update Transaction
    Route::post('success-single/{id}', [UpdateTransactionController::class, 'SuccessSingle'])->name('suppfin.success.single');
    Route::post('failed-single/{id}', [UpdateTransactionController::class, 'FailedSingle'])->name('suppfin.failed.single');
    Route::get('update-result', [UpdateTransactionController::class, 'updateResult'])->name('suppfin.updateResult');
    # BulkUpdate
    Route::get('transaction/bulkupdate/import', [ImportCsvFileController::class, 'index'])->name('suppfin.bulkupdate.create');
    Route::post('transaction/bulkupdate/import', [ImportCsvFileController::class, 'import'])->name('suppfin.bulkupdate.import');
    Route::delete('delete-multiple', [ImportCsvFileController::class, 'deleteMultiple'])->name('suppfin.transaction.delete.multiple');
    Route::post('action-failed-all', [TransactionController::class, 'FailedIds'])->name('suppfin.failedids');
    Route::post('action-successfull-all', [TransactionController::class, 'SuccessfulIds'])->name('suppfin.successids');
    # PayDrc Transaction
    Route::get('paydrc/transaction/history', [PayDrcTransactionController::class, 'daterangePayDrc'])->name('suppfin.paydrc.daterange');
    // Route::post('paydrc/transaction/history', [PayDrcTransactionController::class, 'dataPayDrc'])->name('suppfin.paydrc.daterange.post');

    Route::get('switch/transaction/history', [PayDrcTransactionController::class, 'daterangeSwitch'])->name('suppfin.switch.daterange');
    Route::post('switch/transaction/history', [PayDrcTransactionController::class, 'dataSwitch'])->name('suppfin.switch.daterange.post');


    Route::get('paydrc/payout/overview', [PayDrcTransactionController::class, 'payout'])->name('suppfin.paydrc.payout');
    # Switch Transaction
    Route::get('switch/charge/overview', [SwitchTransactionController::class, 'charge'])->name('suppfin.switch.charge');
    Route::get('switch/payout/overview', [SwitchTransactionController::class, 'payout'])->name('suppfin.switch.payout');
    # Transaction Report
    Route::get('transaction/report/last-week', [TransactionReportController::class, 'LastWeek'])->name('suppfin.report.week');
    Route::get('transaction/report/last-month', [TransactionReportController::class, 'LastMonth'])->name('suppfin.report.month');
    Route::get('transaction/report/daterangepicker', [TransactionReportController::class, 'DateRangePicker'])->name('suppfin.report.daterange');
    # Profil
    Route::get('profil', [ProfilController::class, 'index'])->name('suppfin.profil');
    Route::get('edit-profil', [ProfilController::class, 'edit'])->name('suppfin.profil.edit');
    Route::put('edit-profil', [ProfilController::class, 'update'])->name('suppfin.profil.update');
    # Payment Gateway
    Route::get('api/freshpay/payment', [PaymentGatewayController::class, 'index'])->name('suppfin.payment.create');
    Route::post('api/freshpay/payment', [PaymentGatewayController::class, 'process'])->name('suppfin.payment.process');
    # Callback
    Route::get('send-callback', [SendCallBackToMerchant::class, 'index'])->name('suppfin.callback.create');
    Route::post('send-callback', [SendCallBackToMerchant::class, 'process'])->name('suppfin.callback.process');
    # Verify
    Route::get('api/freshpay/verify', [VerifyAPIController::class, 'index'])->name('suppfin.verify.create');
    Route::post('verify-select-ids', [VerifyAPIController::class, 'VerifyIds'])->name('suppfin.verifyids');
    Route::resource('/api/freshpay/verify/search', FreshPayAPIController::class);
    Route::post('/api/freshpay/verify/search/process', [VerifyAPIController::class,'verifySearch'])->name('suppfin.verify.search');
    Route::post('api/freshpay/verify/upload', [VerifyAPIController::class, 'uploadVerify'])->name('suppfin.transaction.verify.upload');
    # Institution
    Route::get('institution', [InstitutionController::class, 'index'])->name('suppfin.institution.create');
    Route::post('institution', [InstitutionController::class, 'store'])->name('suppfin.institution.store');
    Route::get('institution-user', [InstitutionController::class, 'user'])->name('suppfin.institution-user.create');
    Route::post('institution-user', [InstitutionController::class, 'storeUser'])->name('suppfin.institution-user.store');
    # Merchant
    Route::get('merchant', [MerchantController::class, 'index'])->name('suppfin.merchant.create');
    Route::post('merchant', [MerchantController::class, 'store'])->name('suppfin.merchant.store');
    # Finance
    Route::get('pending-payout', [FinanceController::class, 'pendingPayout'])->name('suppfin.pending.payout.create');
    Route::post('pending-payout', [FinanceController::class, 'pendingPayoutPost'])->name('suppfin.pending.payout.process');

    Route::get('merchant-balance', [FinanceController::class, 'indexBalance'])->name('suppfin.merchant.balance.create');
    Route::post('merchant-balance', [FinanceController::class, 'getBalance'])->name('suppfin.merchant.balance.get');

    Route::get('top-up-wallet', [FinanceController::class, 'TopUpWallet'])->name('suppfin.wallet.topup');
    Route::post('top-up-wallet', [FinanceController::class, 'WalletTopUpRequest'])->name('suppfin.wallet.topup.post');

    Route::get('initiate-transfer', [FinanceController::class, 'transfer'])->name('suppfin.transfert');
    Route::post('initiate-transfer', [FinanceController::class, 'initiateTransfer'])->name('suppfin.transfert.initiate');

    Route::get('wallet-history', [FinanceController::class, 'history'])->name('suppfin.wallet.history');
});


Route::middleware('auth')->group(function () {

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

