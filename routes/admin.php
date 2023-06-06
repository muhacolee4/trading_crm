<?php

use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\CrmController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\LogicController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\ManageUsersController;
use App\Http\Controllers\Admin\ManageDepositController;
use App\Http\Controllers\Admin\ManageWithdrawalController;
use App\Http\Controllers\Admin\InvPlanController;
use App\Http\Controllers\Admin\ManageAdminController;
use App\Http\Controllers\Admin\KycController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\FrontendController;
use App\Http\Controllers\Admin\Settings\AppSettingsController;
use App\Http\Controllers\Admin\Settings\ReferralSettings;
use App\Http\Controllers\Admin\Settings\PaymentController;
use App\Http\Controllers\Admin\Settings\SubscriptionSettings;
use App\Http\Controllers\Admin\IpaddressController;
use App\Http\Controllers\Admin\TwoFactorController;
use App\Http\Controllers\Admin\ClearCacheController;
use App\Http\Controllers\Admin\ImportController;
use App\Http\Controllers\Admin\ManageAssetController;
use App\Http\Controllers\Admin\MembershipController;
use App\Http\Controllers\Admin\SignalProvderController;
use App\Http\Controllers\Admin\TopupController;
use App\Http\Controllers\Admin\TradingAccountController;
use App\Http\Controllers\Admin\TradingPaymentController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
	Route::get('login', [LoginController::class, 'showLoginForm'])->name('adminloginform')->middleware('adminguest');
	Route::post('login', [LoginController::class, 'adminlogin'])->name('adminlogin');
	Route::post('logout', [LoginController::class, 'adminlogout'])->name('adminlogout');
	Route::get('dashboard', [LoginController::class, 'validate_admin'])->name('validate_admin');
});

// Two Factor controller for Admin.
Route::get('admin/2fa', [TwoFactorController::class, 'showTwoFactorForm'])->name('2fa');
Route::post('admin/twofa', [TwoFactorController::class, 'verifyTwoFactor'])->name('twofalogin');
Route::get('admin/forgot-password', [ForgotPasswordController::class, 'forgotPassword'])->name('admin.forgetpassword');
Route::post('admin/send-request', [ForgotPasswordController::class, 'sendPasswordRequest'])->name('sendpasswordrequest');
Route::get('/admin/reset-password/{email}', [ForgotPasswordController::class, 'resetPassword'])->name('resetview');
Route::post('/reset-password-admin', [ForgotPasswordController::class, 'validateResetPasswordToken'])->name('restpass');



Route::middleware(['isadmin', '2fa'])->prefix('admin')->group(function () {
	Route::get('dashboard', [HomeController::class, 'index'])->name('admin.dashboard');
	Route::get('dashboard/plans', [HomeController::class, 'plans'])->name('plans');
	Route::get('dashboard/new-plan', [HomeController::class, 'newplan'])->name('newplan');
	Route::get('dashboard/edit-plan/{id}', [HomeController::class, 'editplan'])->name('editplan');
	Route::get('dashboard/manageusers', [HomeController::class, 'manageusers'])->name('manageusers');
	//Route::get('dashboard/manageusers', ManageUsers::class)->name('manageusers');
	Route::get('dashboard/manage-crypto-assets', [HomeController::class, 'managecryptoasset'])->name('managecryptoasset');

	Route::get('/dashboard/active-investments', [HomeController::class, 'activeInvestments'])->name('activeinvestments');

	// CRM ROUTES
	Route::get('dashboard/calendar', [HomeController::class, 'calendar'])->name('calendar');
	Route::get('dashboard/task', [HomeController::class, 'showtaskpage'])->name('task');
	Route::get('dashboard/mtask', [HomeController::class, 'mtask'])->name('mtask');
	Route::get('dashboard/viewtask', [HomeController::class, 'viewtask'])->name('viewtask');
	Route::get('dashboard/customer', [HomeController::class, 'customer'])->name('customer');
	Route::get('dashboard/leads', [HomeController::class, 'leads'])->name('leads');
	Route::get('dashboard/leadsassign', [HomeController::class, 'leadsassign'])->name('leadsassign');

	Route::post('dashboard/addtask', [CrmController::class, 'addtask'])->name('addtask');
	Route::post('dashboard/updatetask', [CrmController::class, 'updatetask'])->name('updatetask');
	Route::get('dashboard/deltask/{id}', [CrmController::class, 'deltask'])->name('deltask');
	Route::get('dashboard/markdone/{id}', [CrmController::class, 'markdone'])->name('markdone');
	Route::post('dashboard/updateuser', [CrmController::class, 'updateuser'])->name('updateuser');
	Route::get('dashboard/convert/{id}', [CrmController::class, 'convert'])->name('convert');
	Route::get('download-doc', [ImportController::class, 'downloadDoc'])->name('downlddoc');

	// This route is used to Assign Users
	Route::post('dashboard/assign', [CrmController::class, 'assign'])->name('assignuser');

	Route::get('dashboard/user-plans/{id}',  [HomeController::class, 'userplans'])->name('user.plans');
	Route::get('dashboard/user-wallet/{id}',  [ManageUsersController::class, 'userwallet'])->name('user.wallet');
	Route::get('dashboard/fetchusers',  [ManageUsersController::class, 'fetchUsers'])->name('fetchusers');

	Route::get('dashboard/email-services',  [HomeController::class, 'emailServices'])->name('emailservices');
	Route::get('dashboard/about',  [HomeController::class, 'aboutonlinetrade'])->name('aboutonlinetrade');
	Route::get('dashboard/mwithdrawals',  [HomeController::class, 'mwithdrawals'])->name('mwithdrawals');
	Route::get('dashboard/mdeposits', [HomeController::class, 'mdeposits'])->name('mdeposits');
	Route::get('dashboard/agents',  [HomeController::class, 'agents'])->name('agents');
	Route::get('dashboard/addmanager', [HomeController::class, 'addmanager'])->name('addmanager');
	Route::get('dashboard/madmin', [HomeController::class, 'madmin'])->name('madmin');
	Route::get('dashboard/msubtrade', [HomeController::class, 'msubtrade'])->name('msubtrade');
	Route::get('dashboard/settings', [HomeController::class, 'settings'])->name('settings');
	Route::get('dashboard/frontpage', [HomeController::class, 'frontpage'])->name('frontpage');
	Route::get('dashboard/ipaddress', [IpaddressController::class, 'index'])->name('ipaddress');
	Route::get('dashboard/allipaddress', [IpaddressController::class, 'getaddress'])->name('allipaddress');
	Route::get('dashboard/delete-ip/{id}', [IpaddressController::class, 'deleteip'])->name('deleteip');
	Route::post('dashboard/add-ip', [IpaddressController::class, 'addipaddress'])->name('addipaddress');

	Route::get('dashboard/adduser', [HomeController::class, 'adduser'])->name('adduser');

	Route::post('dashboard/addplan', [InvPlanController::class, 'addplan'])->name('addplan');
	Route::post('dashboard/updateplan', [InvPlanController::class, 'updateplan'])->name('updateplan');
	Route::post('dashboard/topup', [TopupController::class, 'topup'])->name('topup');
	Route::post('dashboard/sendmailsingle', [ManageUsersController::class, 'sendmailtooneuser'])->name('sendmailtooneuser');
	Route::post('dashboard/AddHistory', [ManageUsersController::class, 'addHistory'])->name('addhistory');
	Route::post('dashboard/edituser', [ManageUsersController::class, 'edituser'])->name('edituser');
	Route::get('dashboard/getusers/{num}/{item}/{order}', [ManageUsersController::class, 'getusers'])->name('getusers');
	Route::get('dashboard/resetpswd/{id}', [ManageUsersController::class, 'resetpswd'])->name('resetpswd');
	Route::get('dashboard/login-activity/{id}', [ManageUsersController::class, 'loginactivity'])->name('loginactivity');
	Route::get('dashboard/clear-activity/{id}', [ManageUsersController::class, 'clearactivity'])->name('clearactivity');
	Route::get('dashboard/add-referral/{id}', [ManageUsersController::class, 'showUsers'])->name('showusers');
	Route::post('dashboard/add-referral', [ManageUsersController::class, 'addReferral'])->name('addref');

	Route::get('dashboard/switchuser/{id}', [ManageUsersController::class, 'switchuser']);
	Route::get('dashboard/clearacct/{id}', [ManageUsersController::class, 'clearacct'])->name('clearacct');
	Route::get('dashboard/deldeposit/{id}', [ManageDepositController::class, 'deldeposit'])->name('deldeposit');
	Route::get('dashboard/pdeposit/{id}', [ManageDepositController::class, 'pdeposit'])->name('pdeposit');
	Route::get('dashboard/viewimage/{id}', [ManageDepositController::class, 'viewdepositimage'])->name('viewdepositimage');

	Route::post('dashboard/pwithdrawal', [ManageWithdrawalController::class, 'pwithdrawal'])->name('pwithdrawal');
	Route::get('dashboard/process-withdrawal-request/{id}', [ManageWithdrawalController::class, 'processwithdraw'])->name('processwithdraw');


	Route::post('dashboard/addagent', [LogicController::class, 'addagent']);
	Route::get('dashboard/viewagent/{agent}', [LogicController::class, 'viewagent'])->name('viewagent');
	Route::get('dashboard/delagent/{id}', [LogicController::class, 'delagent'])->name('delagent');
	// Settings Update Routes

	Route::post('dashboard/updatesettings', [SettingsController::class, 'updatesettings']);

	Route::post('dashboard/updateasset', [SettingsController::class, 'updateasset']);
	Route::post('dashboard/updatemarket', [SettingsController::class, 'updatemarket']);
	Route::post('dashboard/updatefee', [SettingsController::class, 'updatefee']);


	// clear cache
	Route::get('dashboard/clearcache', [ClearCacheController::class, 'clearcache'])->name('clearcache');

	// Update App Information
	Route::put('dashboard/updatewebinfo', [AppSettingsController::class, 'updatewebinfo'])->name('updatewebinfo');
	Route::put('dashboard/updatepreference', [AppSettingsController::class, 'updatepreference'])->name('updatepreference');
	Route::put('dashboard/updateemail', [AppSettingsController::class, 'updateemail'])->name('updateemailpreference');

	// Update referral settings info
	Route::put('dashboard/update-bonus', [ReferralSettings::class, 'updaterefbonus'])->name('updaterefbonus');

	// Update other bonus settings info
	Route::put('dashboard/other-bonus', [ReferralSettings::class, 'otherBonus'])->name('otherbonus');

	// update subscription
	Route::put('dashboard/updatesubfee', [SubscriptionSettings::class, 'updatesubfee'])->name('updatesubfee');

	// Payment settings
	Route::post('dashboard/addwdmethod', [PaymentController::class, 'addpaymethod'])->name('addpaymethod');
	Route::put('dashboard/updatewdmethod', [PaymentController::class, 'updatewdmethod']);
	Route::get('dashboard/edit-method/{id}', [PaymentController::class, 'editmethod'])->name('editpaymethod');
	Route::get('dashboard/delete-method/{id}', [PaymentController::class, 'deletepaymethod'])->name('deletepaymethod');
	Route::put('dashboard/update-method', [PaymentController::class, 'updatemethod'])->name('updatemethod');
	Route::put('dashboard/paypreference', [PaymentController::class, 'paypreference'])->name('paypreference');
	Route::put('dashboard/updatecpd', [PaymentController::class, 'updatecpd'])->name('updatecpd');
	Route::put('dashboard/updategateway', [PaymentController::class, 'updategateway'])->name('updategateway');
	Route::put('dashboard/update-transfer-settings', [PaymentController::class, 'updateTransfer'])->name('updatetransfer');

	Route::get('dashboard/delsub/{id}',  [SubscriptionController::class, 'delsub']);
	Route::get('dashboard/confirmsub/{id}',  [SubscriptionController::class, 'confirmsub']);
	Route::post('dashboard/saveuser', [ManageUsersController::class, 'saveuser'])->name('createuser');
	Route::get('dashboard/user-details/{id}', [ManageUsersController::class, 'viewuser'])->name('viewuser');


	Route::get('dashboard/unblock/{id}', [ManageAdminController::class, 'unblockadmin']);
	Route::get('dashboard/ublock/{id}', [ManageAdminController::class, 'blockadmin']);
	Route::get('dashboard/deleletadmin/{id}', [ManageAdminController::class, 'deleteadminacnt'])->name('deleteadminacnt');
	Route::post('dashboard/editadmin', [ManageAdminController::class, 'editadmin'])->name('editadmin');
	Route::get('dashboard/adminchangepassword', [ManageAdminController::class, 'adminchangepassword']);
	Route::post('dashboard/adminupdatepass', [ManageAdminController::class, 'adminupdatepass'])->name('adminupdatepass');
	Route::get('dashboard/resetadpwd/{id}', [ManageAdminController::class, 'resetadpwd'])->name('resetadpwd');
	Route::post('dashboard/sendmail', [ManageAdminController::class, 'sendmail'])->name('sendmailtoadmin');
	Route::post('dashboard/changestyle', [ManageAdminController::class, 'changestyle'])->name('changestyle');
	Route::post('dashboard/saveadmin', [ManageAdminController::class, 'saveadmin']);
	Route::post('dashboard/update-profile', [ManageAdminController::class, 'updateadminprofile'])->name('upadprofile');

	Route::get('dashboard/email-verify/{id}', [ManageUsersController::class, 'emailverify'])->name('emailverify');

	// KYC Routes
	Route::get('dashboard/kyc-applications', [HomeController::class, 'kyc'])->name('kyc');
	Route::post('dashboard/processkyc', [KycController::class, 'processKyc'])->name('processkyc');
	Route::get('dashboard/kyc-application/{id}', [HomeController::class, 'viewKycApplication'])->name('viewkyc');


	Route::get('dashboard/uublock/{id}', [ManageUsersController::class, 'ublock']);
	Route::get('dashboard/uunblock/{id}', [ManageUsersController::class, 'unblock']);
	Route::get('dashboard/delsystemuser/{id}', [ManageUsersController::class, 'delsystemuser']);
	Route::get('dashboard/usertrademode/{id}/{action}', [ManageUsersController::class, 'usertrademode']);
	Route::post('dashboard/sendmailtoall', [ManageUsersController::class, 'sendmailtoall'])->name('sendmailtoall');

	Route::get('dashboard/trashplan/{id}', [InvPlanController::class, 'trashplan'])->name('trashplan');
	Route::get('dashboard/deletewdmethod/{id}', 'App\Http\Controllers\Admin\SettingsController@deletewdmethod');

	// This Route is for frontpage editing
	Route::post('dashboard/savefaq', [FrontendController::class, 'savefaq'])->name('savefaq');
	Route::post('dashboard/savetestimony', [FrontendController::class, 'savetestimony'])->name('savetestimony');
	Route::post('dashboard/saveimg', [FrontendController::class, 'saveimg'])->name('saveimg');
	Route::post('dashboard/savecontents', [FrontendController::class, 'savecontents'])->name('savecontents');

	//Update Frontend Pages
	Route::post('dashboard/updatefaq', [FrontendController::class, 'updatefaq'])->name('updatefaq');
	Route::post('dashboard/updatetestimony', [FrontendController::class, 'updatetestimony'])->name('updatetestimony');
	Route::post('dashboard/updatecontents', [FrontendController::class, 'updatecontents'])->name('updatecontents');
	Route::post('dashboard/updateimg', [FrontendController::class, 'updateimg'])->name('updateimg');
	Route::get('dashboard/adminprofile', [HomeController::class, 'adminprofile'])->name('adminprofile');

	Route::get('dashboard/deleteplan/{id}', [ManageUsersController::class, 'deleteplan'])->name('deleteplan');
	Route::get('dashboard/approveplan/{id}', [ManageUsersController::class, 'approvePlan'])->name('approveplan');

	Route::get('dashboard/markas/{status}/{id}', [ManageUsersController::class, 'markplanas'])->name('markas');

	// Delete fa and tes routes
	Route::get('dashboard/delfaq/{id}', [FrontendController::class, 'delfaq']);
	Route::get('dashboard/deltestimony/{id}', [FrontendController::class, 'deltest']);
	// privacy policy
	Route::get('dashboard/privacy-policy', [FrontendController::class, 'termspolicy'])->name('termspolicy');
	Route::post('dashboard/privacy-policy', [FrontendController::class, 'savetermspolicy'])->name('savetermspolicy');

	// This route is to import data from excel
	Route::post('dashboard/fileImport', [ImportController::class, 'fileImport'])->name('fileImport');
	Route::post('dashboard/editamount', [ManageDepositController::class, 'editamount'])->name('editamount');

	// Settings Routes
	Route::get('dashboard/settings/app-settings', [AppSettingsController::class, 'appsettingshow'])->name('appsettingshow');
	Route::get('dashboard/settings/referral-settings', [ReferralSettings::class, 'referralview'])->name('refsetshow');
	Route::get('dashboard/settings/payment-settings', [PaymentController::class, 'paymentview'])->name('paymentview');
	Route::get('dashboard/settings/subscription-settings', [SubscriptionSettings::class, 'index'])->name('subview');


	// Crypto Asset
	Route::get('dashboard/setcryptostatus/{asset}/{status}', [ManageAssetController::class, 'setassetstatus'])->name('setassetstatus');
	Route::get('dashboard/useexchange/{value}', [ManageAssetController::class, 'useexchange'])->name('useexchange');
	Route::post('dashboard/exchangefee', [ManageAssetController::class, 'exchangefee'])->name('exchangefee');


	//memebership module
	Route::get('/courses', [MembershipController::class, 'showCourses'])->name('courses');
	Route::post('/add-course', [MembershipController::class, 'addCourse'])->name('addcourse');
	Route::patch('/update-course', [MembershipController::class, 'updateCourse'])->name('updatecourse');
	Route::get('/delete-course/{id}', [MembershipController::class, 'deleteCourse'])->name('deletecourse');

	Route::get('/courses-lessons/{id}', [MembershipController::class, 'showLessons'])->name('lessons');
	Route::post('/add-lesson', [MembershipController::class, 'addLesson'])->name('addlesson');
	Route::patch('/update-lesson', [MembershipController::class, 'updateLesson'])->name('updatedlesson');
	Route::get('/delete-lesson/{id}', [MembershipController::class, 'deleteLesson'])->name('deletelesson');

	Route::get('/categories', [MembershipController::class, 'category'])->name('categories');
	Route::post('/add-category', [MembershipController::class, 'addCategory'])->name('addcategory');
	Route::get('/delete-cat/{id}', [MembershipController::class, 'deleteCategory'])->name('deletecategory');
	Route::get('lessons-without-course', [MembershipController::class, 'lessonWithoutCourse'])->name('less.nocourse');


	// subscription copy trading

	//master account
	Route::get('/trading-settings', [SubscriptionController::class, 'myTradingSettings'])->name('tsettings');
	Route::post('/create-copytrade-account', [SubscriptionController::class, 'createCopyMasterAccount'])->name('create.master');
	Route::get('/delete-master-account/{id}', [SubscriptionController::class, 'deleteMasterAccount'])->name('del.master');
	Route::post('/renew-master-account', [SubscriptionController::class, 'renewAccount'])->name('renew.master');

	//update strategy
	Route::post('/update-strategy', [SubscriptionController::class, 'updateStrategy'])->name('updatestrategy');

	//subscriber account
	Route::get('/trading-accounts', [TradingAccountController::class, 'tradingAccounts'])->name('tacnts');
	Route::post('/create-sub-account', [TradingAccountController::class, 'createSubscriberAccount'])->name('create.sub');
	Route::get('/delete-sub-account/{id}', [TradingAccountController::class, 'deleteSubAccount'])->name('del.sub');
	Route::get('/payment', [TradingPaymentController::class, 'payment'])->name('tra.pay');
	Route::post('/renew-trading-account', [TradingAccountController::class, 'renewAccount'])->name('renew.acnt');
	//Copy trade
	Route::post('/start-copy-account', [TradingAccountController::class, 'copyTrade'])->name('cptrade');
	//deployment.
	Route::get('/deployment/{id}/{deployment}', [TradingAccountController::class, 'deployment'])->name('acnt.deployment');

	/*
		Trading signal modules
		users can subscribe to signal channel to get access
	*/

	//signals
	Route::get('/trading-signals', [SignalProvderController::class, 'tradeSignals'])->name('signals');
	Route::post('/post-signals', [SignalProvderController::class, 'addSignals'])->name('postsignals');
	Route::get('/publish-signals/{signal}', [SignalProvderController::class, 'publishSignals'])->name('pubsignals');
	Route::put('update-result', [SignalProvderController::class, 'updateResult'])->name('updt.result');
	Route::get('delete-signal/{signal}', [SignalProvderController::class, 'deleteSignal'])->name('delete.signal');
	//signal fees 
	Route::get('signal-settings', [SignalProvderController::class, 'settings'])->name('signal.settings');
	Route::put('save-signal-settings', [SignalProvderController::class, 'saveSettings'])->name('save.settings');
	Route::get('chat-id', [SignalProvderController::class, 'getChatId'])->name('chat.id');
	Route::get('delete-id', [SignalProvderController::class, 'deleteChatId'])->name('delete.id');
	//subscribers
	Route::get('signal-subscribers', [SignalProvderController::class, 'subscribers'])->name('signal.subs');
});
// Everything About Admin Route ends here 