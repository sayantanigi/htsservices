<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CarrierController;
use App\Http\Controllers\Admin\MasterdataController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\Admin\HtsUsersController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/clear-cache', function() {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');

    return "Cache is cleared";
});

Route::get('/', 'App\Http\Controllers\HomeController@index');
Route::any('/listing','App\Http\Controllers\ListingController@listing')->name('listing');

Auth::routes();

Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::get('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::get('/dashboard', 'App\Http\Controllers\DashboardController@dashboard')->name('dashboard');
Route::get('/profile', 'App\Http\Controllers\DashboardController@profile')->name('profile');
Route::post('/update-profile',[SettingsController::class, 'update_profile'])->name('update-profile');
Route::post('/update-password',[SettingsController::class, 'update_password'])->name('update-password');

Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::get('/about','App\Http\Controllers\HomeController@aboutUs')->name('about');
Route::get('/help','App\Http\Controllers\HomeController@help')->name('help');
Route::get('/terms-conditions','App\Http\Controllers\HomeController@terms')->name('terms-conditions');
Route::get('/privacy-policy','App\Http\Controllers\HomeController@privacy')->name('privacy-policy');


Route::get('/admin', 'App\Http\Controllers\Auth\AdminLoginController@showAdminLoginForm')->name('admin');
Route::post('/adminlogin', 'App\Http\Controllers\Auth\AdminLoginController@adminLogin')->name('adminlogin');

  
/*------------------------------------------
All Admin Routes List
--------------------------------------------*/
// Route::get('/admin-dashboard', [HomeController::class, 'adminHome'])->name('admin-dashboard');
Route::get('/admin-dashboard', 'App\Http\Controllers\Admin\DashboardController@admin_dashboard')->name('admin-dashboard');
Route::get('/ad-profile',[SettingController::class, 'profile'])->name('ad-profile');
Route::post('/updateAdProfile',[SettingController::class, 'update_profile'])->name('updateAdProfile');
Route::post('/updateAdPassword',[SettingController::class, 'update_password'])->name('updateAdPassword');

Route::get('/employees',[UserController::class, 'users'])->name('employees');
Route::get('/add-employee',[UserController::class, 'addEmployee'])->name('add-employee');
Route::post('/createUser',[UserController::class, 'createUser'])->name('createUser');
Route::post('/updateEmpData/{id}',[UserController::class, 'updateEmpData'])->name('updateEmpData');
Route::get('/editEmployee/{id}',[UserController::class, 'editEmployee'])->name('editEmployee');
Route::get('/viewEmployee/{id}',[UserController::class, 'viewEmployee'])->name('viewEmployee');
Route::post('/updateUser/{id}',[UserController::class, 'updateUser'])->name('updateUser');
Route::post('/updateUserStatus',[UserController::class, 'updateUserStatus'])->name('updateUserStatus');
Route::get('/deleteUser/{id}',[UserController::class, 'deleteUser'])->name('deleteUser');
Route::get('/viewUser/{id}',[UserController::class, 'viewUser'])->name('viewUser');
Route::post('/updateParentEntityEmp',[UserController::class, 'updateParentEntityEmp'])->name('updateParentEntityEmp');
Route::post('/updateParentEntityUsr/{id}',[UserController::class, 'updateParentEntityUsr'])->name('updateParentEntityUsr');
Route::post('/updateUsrAddress',[UserController::class, 'updateUsrAddress'])->name('updateUsrAddress');
Route::post('/updateUsrAddressEmp/{id}',[UserController::class, 'updateUsrAddressEmp'])->name('updateUsrAddressEmp');
Route::post('/updateUsrOtherAddress',[UserController::class, 'updateUsrOtherAddress'])->name('updateUsrOtherAddress');
Route::post('/updateUsrOtherAddressEmp/{id}',[UserController::class, 'updateUsrOtherAddressEmp'])->name('updateUsrOtherAddressEmp');
Route::get('/deleteUsrOtherAddress/{id}',[UserController::class, 'deleteUsrOtherAddress'])->name('deleteUsrOtherAddress');
Route::get('/deleteUsrOtherAddressEmp/{id}',[UserController::class, 'deleteUsrOtherAddressEmp'])->name('deleteUsrOtherAddressEmp');
Route::post('/saveEmployeeOtherAddress',[UserController::class, 'saveEmployeeOtherAddress'])->name('saveEmployeeOtherAddress');
Route::post('/saveEmployeeOtherAddressEmp/{id}',[UserController::class, 'saveEmployeeOtherAddressEmp'])->name('saveEmployeeOtherAddressEmp');

Route::post('/getemployeeimages',[UserController::class, 'getemployeeimages'])->name('getemployeeimages');
Route::post('/getemployeeimagesEdt/{id}',[UserController::class, 'getemployeeimagesEdt'])->name('getemployeeimagesEdt');
Route::post('/upload-employee-images',[UserController::class, 'dropzoneStoreForEmployee'])->name('upload-employee-images');
Route::post('/upload-employee-images-edt/{id}',[UserController::class, 'dropzoneStoreForEmployeeEdt'])->name('upload-employee-images-edt');
Route::get('/deleteEmployeeGalleryImage/{id}',[UserController::class, 'deleteEmployeeGalleryImage'])->name('deleteEmployeeGalleryImage');
Route::get('/deleteEmployeeGalleryImageEdt/{id}',[UserController::class, 'deleteEmployeeGalleryImageEdt'])->name('deleteEmployeeGalleryImageEdt');
Route::post('/addUsrNote',[UserController::class, 'addUsrNote'])->name('addUsrNote');
Route::post('/addUsrNoteEdt/{id}',[UserController::class, 'addUsrNoteEdt'])->name('addUsrNoteEdt');

// Master data
Route::get('/identification-types',[MasterdataController::class, 'identificationTypes'])->name('identification-types');
Route::get('/divisons',[MasterdataController::class, 'divisons'])->name('divisons');
Route::get('/ports',[MasterdataController::class, 'ports'])->name('ports');
Route::get('/carrier-codes',[MasterdataController::class, 'carrierCodes'])->name('carrier-codes');
Route::get('/transportation',[MasterdataController::class, 'transportation'])->name('transportation');
Route::get('/pmt-terms',[MasterdataController::class, 'pmtTerms'])->name('pmt-terms');
Route::get('/freight-service-class',[MasterdataController::class, 'freight_service_class'])->name('freight-service-class');
Route::get('/custom-charge',[MasterdataController::class, 'customCharge'])->name('custom-charge');
Route::get('/frequency',[MasterdataController::class, 'frequency'])->name('frequency');
Route::get('/commodity',[MasterdataController::class, 'commodity'])->name('commodity');
Route::get('/flights',[MasterdataController::class, 'flights'])->name('flights');
Route::post('/createType',[MasterdataController::class, 'createType'])->name('createType');
Route::post('/createDivison',[MasterdataController::class, 'createDivison'])->name('createDivison');
Route::post('/createPort',[MasterdataController::class, 'createPort'])->name('createPort');
Route::post('/createFrequency',[MasterdataController::class, 'createFrequency'])->name('createFrequency');
Route::post('/createCommodity',[MasterdataController::class, 'createCommodity'])->name('createCommodity');
Route::post('/createCarrierCode',[MasterdataController::class, 'createCarrierCode'])->name('createCarrierCode');
Route::post('/createTransportation',[MasterdataController::class, 'createTransportation'])->name('createTransportation');
Route::post('/createPmtTerms',[MasterdataController::class, 'createPmtTerms'])->name('createPmtTerms');
Route::post('/createFreightServiceClass',[MasterdataController::class, 'createFreightServiceClass'])->name('createFreightServiceClass');
Route::post('/createCustomCharge',[MasterdataController::class, 'createCustomCharge'])->name('createCustomCharge');
Route::post('/createFlight',[MasterdataController::class, 'createFlight'])->name('createFlight');
Route::post('/filter_data_exist',[MasterdataController::class, 'filter_data_exist'])->name('filter_data_exist');
Route::get('/deleteIdentificationType/{id}',[MasterdataController::class, 'deleteIdentificationType'])->name('deleteIdentificationType');
Route::get('/deleteDivison/{id}',[MasterdataController::class, 'deleteDivison'])->name('deleteDivison');
Route::get('/deletePort/{id}',[MasterdataController::class, 'deletePort'])->name('deletePort');
Route::get('/deleteFrequency/{id}',[MasterdataController::class, 'deleteFrequency'])->name('deleteFrequency');
Route::get('/deleteCommodity/{id}',[MasterdataController::class, 'deleteCommodity'])->name('deleteCommodity');
Route::get('/deleteCode/{id}',[MasterdataController::class, 'deleteCode'])->name('deleteCode');
Route::get('/deleteTransportation/{id}',[MasterdataController::class, 'deleteTransportation'])->name('deleteTransportation');
Route::get('/deletePmtTerms/{id}',[MasterdataController::class, 'deletePmtTerms'])->name('deletePmtTerms');
Route::get('/deleteFreightServiceClass/{id}',[MasterdataController::class, 'deleteFreightServiceClass'])->name('deleteFreightServiceClass');
Route::get('/deleteCustomCharge/{id}',[MasterdataController::class, 'deleteCustomCharge'])->name('deleteCustomCharge');
Route::get('/deleteFlight/{id}',[MasterdataController::class, 'deleteFlight'])->name('deleteFlight');
Route::post('/updateIdentiTypeStatus',[MasterdataController::class, 'updateIdentiTypeStatus'])->name('updateIdentiTypeStatus');
Route::post('/changeDivisonStatus',[MasterdataController::class, 'changeDivisonStatus'])->name('changeDivisonStatus');
Route::post('/changePortStatus',[MasterdataController::class, 'changePortStatus'])->name('changePortStatus');
Route::post('/changeFrequencyStatus',[MasterdataController::class, 'changeFrequencyStatus'])->name('changeFrequencyStatus');
Route::post('/changeCommodityStatus',[MasterdataController::class, 'changeCommodityStatus'])->name('changeCommodityStatus');
Route::post('/changeCodeStatus',[MasterdataController::class, 'changeCodeStatus'])->name('changeCodeStatus');
Route::post('/changeTransportationStatus',[MasterdataController::class, 'changeTransportationStatus'])->name('changeTransportationStatus');
Route::post('/changeFreightServiceClass',[MasterdataController::class, 'changeFreightServiceClass'])->name('changeFreightServiceClass');
Route::post('/changeChargeStatus',[MasterdataController::class, 'changeChargeStatus'])->name('changeChargeStatus');
Route::post('/changeFlightStatus',[MasterdataController::class, 'changeFlightStatus'])->name('changeFlightStatus');
Route::post('/updateIdentification',[MasterdataController::class, 'updateIdentification'])->name('updateIdentification');
Route::post('/updateDivison',[MasterdataController::class, 'updateDivison'])->name('updateDivison');
Route::post('/updatePort',[MasterdataController::class, 'updatePort'])->name('updatePort');
Route::post('/updateFrequency',[MasterdataController::class, 'updateFrequency'])->name('updateFrequency');
Route::post('/updateCommodity',[MasterdataController::class, 'updateCommodity'])->name('updateCommodity');
Route::post('/updateCarrierCode',[MasterdataController::class, 'updateCarrierCode'])->name('updateCarrierCode');
Route::post('/updateTransportation',[MasterdataController::class, 'updateTransportation'])->name('updateTransportation');
Route::post('/updatePmtTerms',[MasterdataController::class, 'updatePmtTerms'])->name('updatePmtTerms');
Route::post('/updateFreightServiceClass',[MasterdataController::class, 'updateFreightServiceClass'])->name('updateFreightServiceClass');
Route::post('/updateCustomCharge',[MasterdataController::class, 'updateCustomCharge'])->name('updateCustomCharge');
Route::post('/updateFlight',[MasterdataController::class, 'updateFlight'])->name('updateFlight');
Route::post('/createListing',[MasterdataController::class, 'createListing'])->name('createListing');

Route::get('participation',[MasterdataController::class, 'participationList'])->name('participation');
Route::post('create-participation',[MasterdataController::class, 'createParticipation'])->name('create-participation');
Route::post('update-participation',[MasterdataController::class, 'updateParticipation'])->name('update-participation');
Route::post('change-participation-status',[MasterdataController::class, 'changeParticipationStatus'])->name('change-participation-status');
Route::get('delete-participation/{id}',[MasterdataController::class, 'deleteParticipation'])->name('delete-participation');

// Carrier
Route::get('/add-carrier/{id}',[CarrierController::class, 'addCarrier'])->name('add-carrier');
// Route::any('/carriers',[CarrierController::class, 'carrier_list'])->name('carriers');
// Route::match(['get', 'post'], '/example', 'ExampleController@method');
Route::get('/editCarrier/{id}',[CarrierController::class, 'editCarrier'])->name('editCarrier');
Route::get('/viewCarrier/{id}',[CarrierController::class, 'viewCarrier'])->name('viewCarrier');
Route::match(['get', 'post'], '/carriers',[CarrierController::class, 'carrier_list'])->name('carriers');
Route::post('/createCarrier',[CarrierController::class, 'createCarrier'])->name('createCarrier');
Route::post('/updateCarrierData',[CarrierController::class, 'updateCarrierData'])->name('updateCarrierData');
Route::post('/createCarrierContact',[CarrierController::class, 'createCarrierContact'])->name('createCarrierContact');
Route::post('/createCarrierContactEdt',[CarrierController::class, 'createCarrierContactEdt'])->name('createCarrierContactEdt');
Route::post('/createCarrierRateGround',[CarrierController::class, 'createCarrierRateGround'])->name('createCarrierRateGround');
Route::post('/createCarrierRateGroundEdt',[CarrierController::class, 'createCarrierRateGroundEdt'])->name('createCarrierRateGroundEdt');
Route::post('/createCarrierCustomCharge',[CarrierController::class, 'createCarrierCustomCharge'])->name('createCarrierCustomCharge');
Route::post('/createCustomCarrierChargeEdt',[CarrierController::class, 'createCustomCarrierChargeEdt'])->name('createCustomCarrierChargeEdt');
Route::post('/createCustomChargeAutoCreation',[CarrierController::class, 'createCustomChargeAutoCreation'])->name('createCustomChargeAutoCreation');
Route::post('/createCustomChargeAutoCreationEdt',[CarrierController::class, 'createCustomChargeAutoCreationEdt'])->name('createCustomChargeAutoCreationEdt');
Route::post('/getState',[CarrierController::class, 'getState'])->name('getState');
Route::post('/getCity',[CarrierController::class, 'getCity'])->name('getCity');
Route::post('/getRateVal',[CarrierController::class, 'getRateVal'])->name('getRateVal');
Route::post('/updateCarrierAddress',[CarrierController::class, 'updateCarrierAddress'])->name('updateCarrierAddress');
Route::post('/updateCarrierPmtTerms',[CarrierController::class, 'updateCarrierPmtTerms'])->name('updateCarrierPmtTerms');
Route::post('/updateCarrierPmtTermsEdt',[CarrierController::class, 'updateCarrierPmtTermsEdt'])->name('updateCarrierPmtTermsEdt');
Route::post('/updateCarrierMoreInfo',[CarrierController::class, 'updateCarrierMoreInfo'])->name('updateCarrierMoreInfo');
Route::post('/updateCarrierMoreInfoEdt',[CarrierController::class, 'updateCarrierMoreInfoEdt'])->name('updateCarrierMoreInfoEdt');
Route::post('/updateCarrierEdtAddress',[CarrierController::class, 'updateCarrierEdtAddress'])->name('updateCarrierEdtAddress');
Route::post('/addCarrierNote',[CarrierController::class, 'addCarrierNote'])->name('addCarrierNote');
Route::post('/addCarrierNoteEdt',[CarrierController::class, 'addCarrierNoteEdt'])->name('addCarrierNoteEdt');
Route::post('/updateParentEntity',[CarrierController::class, 'updateParentEntity'])->name('updateParentEntity');
Route::post('/updateParentEntityEdt',[CarrierController::class, 'updateParentEntityEdt'])->name('updateParentEntityEdt');
Route::post('/updateLandCarrierCode',[CarrierController::class, 'updateLandCarrierCode'])->name('updateLandCarrierCode');
Route::post('/updateLandCarrierCodeEdt',[CarrierController::class, 'updateLandCarrierCodeEdt'])->name('updateLandCarrierCodeEdt');
Route::post('/updateOceanCarrierCode',[CarrierController::class, 'updateOceanCarrierCode'])->name('updateOceanCarrierCode');
Route::post('/updateOceanCarrierCodeEdt',[CarrierController::class, 'updateOceanCarrierCodeEdt'])->name('updateOceanCarrierCodeEdt');
Route::post('/updateAirCarrierCode',[CarrierController::class, 'updateAirCarrierCode'])->name('updateAirCarrierCode');
Route::post('/updateAirCarrierCodeEdt',[CarrierController::class, 'updateAirCarrierCodeEdt'])->name('updateAirCarrierCodeEdt');
Route::post('/updateConCarrierAddress',[CarrierController::class, 'updateConCarrierAddress'])->name('updateConCarrierAddress');
Route::post('/updateConCarrierAddressEdt',[CarrierController::class, 'updateConCarrierAddressEdt'])->name('updateConCarrierAddressEdt');
Route::post('/updateCarrierBillingAddress',[CarrierController::class, 'updateCarrierBillingAddress'])->name('updateCarrierBillingAddress');
Route::post('/updateCarrierBillingAddressEdt',[CarrierController::class, 'updateCarrierBillingAddressEdt'])->name('updateCarrierBillingAddressEdt');
Route::post('/updateCarrierConBillingAddress',[CarrierController::class, 'updateCarrierConBillingAddress'])->name('updateCarrierConBillingAddress');
Route::post('/updateCarrierConBillingAddressEdt',[CarrierController::class, 'updateCarrierConBillingAddressEdt'])->name('updateCarrierConBillingAddressEdt');
Route::post('/updateCarrierOtherAddress',[CarrierController::class, 'updateCarrierOtherAddress'])->name('updateCarrierOtherAddress');
Route::post('/updateCarrierOtherAddressEdt',[CarrierController::class, 'updateCarrierOtherAddressEdt'])->name('updateCarrierOtherAddressEdt');
Route::post('/updateCarrierContOtherAddress',[CarrierController::class, 'updateCarrierContOtherAddress'])->name('updateCarrierContOtherAddress');
Route::post('/updateCarrierContOtherAddressEdt',[CarrierController::class, 'updateCarrierContOtherAddressEdt'])->name('updateCarrierContOtherAddressEdt');
Route::post('/updateCarrierContDateOfBirth',[CarrierController::class, 'updateCarrierContDateOfBirth'])->name('updateCarrierContDateOfBirth');
Route::post('/updateCarrierContDateOfBirthEdt',[CarrierController::class, 'updateCarrierContDateOfBirthEdt'])->name('updateCarrierContDateOfBirthEdt');
Route::post('/updateCarrierRateContract',[CarrierController::class, 'updateCarrierRateContract'])->name('updateCarrierRateContract');
Route::post('/updateCarrierRateContractEdt',[CarrierController::class, 'updateCarrierRateContractEdt'])->name('updateCarrierRateContractEdt');
Route::post('/saveCarrierOtherAddress',[CarrierController::class, 'saveCarrierOtherAddress'])->name('saveCarrierOtherAddress');
Route::post('/saveCarrierOtherAddressEdt',[CarrierController::class, 'saveCarrierOtherAddressEdt'])->name('saveCarrierOtherAddressEdt');
Route::get('/deleteCarrier/{id}',[CarrierController::class, 'deleteCarrier'])->name('deleteCarrier');
Route::get('/deleteOtherAddress/{id}',[CarrierController::class, 'deleteOtherAddress'])->name('deleteOtherAddress');
Route::get('/deleteOtherAddressEdt/{id}',[CarrierController::class, 'deleteOtherAddressEdt'])->name('deleteOtherAddressEdt');
Route::post('/upload-images',[CarrierController::class, 'dropzoneStore'])->name('upload-images');
Route::post('/upload-images-edt',[CarrierController::class, 'dropzoneStoreEdt'])->name('upload-images-edt');
Route::post('/create-notes',[CarrierController::class, 'createNotes'])->name('create-notes');
Route::post('/create-notes-edt',[CarrierController::class, 'createNotesEdt'])->name('create-notes-edt');
Route::post('/create-rate-notes',[CarrierController::class, 'createRateNotes'])->name('create-rate-notes');
Route::post('/create-rate-notes-edt',[CarrierController::class, 'createRateNotesEdt'])->name('create-rate-notes-edt');
Route::post('/getimages',[CarrierController::class, 'getimages'])->name('getimages');
Route::post('/getimagesedt',[CarrierController::class, 'getimagesEdt'])->name('getimagesedt');
Route::get('/deleteGalleryImage/{id}',[CarrierController::class, 'deleteGalleryImage'])->name('deleteGalleryImage');
Route::get('/deleteGalleryImageEdt/{id}',[CarrierController::class, 'deleteGalleryImageEdt'])->name('deleteGalleryImageEdt');
Route::get('/deleteConNote/{id}',[CarrierController::class, 'deleteConNote'])->name('deleteConNote');
Route::get('/deleteConNoteEdt/{id}',[CarrierController::class, 'deleteConNoteEdt'])->name('deleteConNoteEdt');
Route::get('/deleteNote/{id}',[CarrierController::class, 'deleteNote'])->name('deleteNote');
Route::get('/deleteNoteEdt/{id}',[CarrierController::class, 'deleteNoteEdt'])->name('deleteNoteEdt');
Route::get('/deleteConTabData/{id}',[CarrierController::class, 'deleteConTabData'])->name('deleteConTabData');
Route::get('/deleteConTabDataEdt/{id}',[CarrierController::class, 'deleteConTabDataEdt'])->name('deleteConTabDataEdt');
Route::get('/deleteRateGroundTabData/{id}',[CarrierController::class, 'deleteRateGroundTabData'])->name('deleteRateGroundTabData');
Route::get('/deleteRateGroundTabDataEdt/{id}',[CarrierController::class, 'deleteRateGroundTabDataEdt'])->name('deleteRateGroundTabDataEdt');
Route::get('/deleteChargeTabData/{id}',[CarrierController::class, 'deleteChargeTabData'])->name('deleteChargeTabData');
Route::get('/deleteChargeTabDataEdt/{id}',[CarrierController::class, 'deleteChargeTabDataEdt'])->name('deleteChargeTabDataEdt');

Route::post('/saveCarrierConNote',[CarrierController::class, 'saveCarrierConNote'])->name('saveCarrierConNote');
Route::post('/saveCarrierConNoteEdit',[CarrierController::class, 'saveCarrierConNoteEdit'])->name('saveCarrierConNoteEdit');
Route::post('/saveCarrierNote',[CarrierController::class, 'saveCarrierNote'])->name('saveCarrierNote');
Route::post('/saveCarrierNoteEdt',[CarrierController::class, 'saveCarrierNoteEdt'])->name('saveCarrierNoteEdt');
Route::post('/getcarrierimages',[CarrierController::class, 'getcarrierimages'])->name('getcarrierimages');
Route::post('/getcarrierimagesedt',[CarrierController::class, 'getcarrierimagesedt'])->name('getcarrierimagesedt');
Route::post('/upload-carrier-images',[CarrierController::class, 'dropzoneStoreForCarrier'])->name('upload-carrier-images');
Route::post('/upload-carrier-images-edt',[CarrierController::class, 'dropzoneStoreForCarrierEdt'])->name('upload-carrier-images-edt');
Route::get('/deleteCarrierGalleryImage/{id}',[CarrierController::class, 'deleteCarrierGalleryImage'])->name('deleteCarrierGalleryImage');
Route::get('/deleteCarrierGalleryImageEdt/{id}',[CarrierController::class, 'deleteCarrierGalleryImageEdt'])->name('deleteCarrierGalleryImageEdt');



// HTS Users
Route::match(['get', 'post'], '/agents',[HtsUsersController::class, 'agent_list'])->name('agents');
Route::get('/add-agent/{id}',[HtsUsersController::class, 'addAgent'])->name('add-agent');
Route::post('/createHtsUser',[HtsUsersController::class, 'createHtsUser'])->name('createHtsUser');
Route::post('/updateHtsUserAddress',[HtsUsersController::class, 'updateHtsUserAddress'])->name('updateHtsUserAddress');
Route::post('/updateHtsBillingAddress',[HtsUsersController::class, 'updateHtsBillingAddress'])->name('updateHtsBillingAddress');
Route::post('/updateHtsOtherAddress',[HtsUsersController::class, 'updateHtsOtherAddress'])->name('updateHtsOtherAddress');
Route::post('/saveHtsOtherAddress',[HtsUsersController::class, 'saveHtsOtherAddress'])->name('saveHtsOtherAddress');
Route::get('/deleteHtsOtherAddress/{id}',[HtsUsersController::class, 'deleteHtsOtherAddress'])->name('deleteHtsOtherAddress');
Route::post('/updateHtsParentEntity',[HtsUsersController::class, 'updateHtsParentEntity'])->name('updateHtsParentEntity');
Route::post('/changeHtsUserStatus',[HtsUsersController::class, 'changeHtsUserStatus'])->name('changeHtsUserStatus');
Route::get('/deleteHtsUser/{id}/{url}',[HtsUsersController::class, 'deleteHtsUser'])->name('deleteHtsUser');
Route::post('/createHtsContact',[HtsUsersController::class, 'createHtsContact'])->name('createHtsContact');
Route::post('/updateConHtsAddress',[HtsUsersController::class, 'updateConHtsAddress'])->name('updateConHtsAddress');
Route::get('/deleteHtsConTabData/{id}',[HtsUsersController::class, 'deleteHtsConTabData'])->name('deleteHtsConTabData');
Route::post('/updateHtsConBillingAddress',[HtsUsersController::class, 'updateHtsConBillingAddress'])->name('updateHtsConBillingAddress');
Route::post('/updateHtsContOtherAddress',[HtsUsersController::class, 'updateHtsContOtherAddress'])->name('updateHtsContOtherAddress');
Route::post('/updateHtsContDateOfBirth',[HtsUsersController::class, 'updateHtsContDateOfBirth'])->name('updateHtsContDateOfBirth');
Route::post('/upload-hts-images',[HtsUsersController::class, 'dropzoneHtsStore'])->name('upload-hts-images');
Route::post('/gethtsimages',[HtsUsersController::class, 'gethtsimages'])->name('gethtsimages');
Route::get('/deleteHtsGalleryImage/{id}',[HtsUsersController::class, 'deleteHtsGalleryImage'])->name('deleteHtsGalleryImage');
Route::post('/create-hts-notes',[HtsUsersController::class, 'createHtsNotes'])->name('create-hts-notes');
Route::post('/saveHtsConNote',[HtsUsersController::class, 'saveHtsConNote'])->name('saveHtsConNote');
Route::get('/deleteHtsConNote/{id}',[HtsUsersController::class, 'deleteHtsConNote'])->name('deleteHtsConNote');
Route::post('/createHtsRateGround',[HtsUsersController::class, 'createHtsRateGround'])->name('createHtsRateGround');
Route::post('/updateHtsRateContract',[HtsUsersController::class, 'updateHtsRateContract'])->name('updateHtsRateContract');
Route::post('/create-hts-rate-notes',[HtsUsersController::class, 'createHtsRateNotes'])->name('create-hts-rate-notes');
Route::get('/deleteHtsRateGroundTabData/{id}',[HtsUsersController::class, 'deleteHtsRateGroundTabData'])->name('deleteHtsRateGroundTabData');
Route::post('/createHtsCustomCharge',[HtsUsersController::class, 'createHtsCustomCharge'])->name('createHtsCustomCharge');
Route::post('/createHtsCustomChargeAutoCreation',[HtsUsersController::class, 'createHtsCustomChargeAutoCreation'])->name('createHtsCustomChargeAutoCreation');
Route::get('/deleteHtsChargeTabData/{id}',[HtsUsersController::class, 'deleteHtsChargeTabData'])->name('deleteHtsChargeTabData');
Route::post('/upload-hts-gallery-images',[HtsUsersController::class, 'dropzoneStoreForHtsGallery'])->name('upload-hts-gallery-images');
Route::post('/gethtsgalleryimages',[HtsUsersController::class, 'gethtsgallerytimages'])->name('gethtsgalleryimages');
Route::get('/deleteHtsMainGalleryImage/{id}',[HtsUsersController::class, 'deleteHtsMainGalleryImage'])->name('deleteHtsMainGalleryImage');
Route::post('/addHtsNote',[HtsUsersController::class, 'addHtsNote'])->name('addHtsNote');
Route::post('/saveHtsNote',[HtsUsersController::class, 'saveHtsNote'])->name('saveHtsNote');
Route::get('/deleteHtsNote/{id}',[HtsUsersController::class, 'deleteHtsNote'])->name('deleteHtsNote');
Route::post('/updateHtsUserAgent',[HtsUsersController::class, 'updateHtsUserAgent'])->name('updateHtsUserAgent');

Route::post('create-participation-inner',[HtsUsersController::class, 'createParticipation'])->name('create-participation-inner');
Route::get('delete-participation-details/{id}',[HtsUsersController::class, 'deleteParticipationDetails'])->name('delete-participation-details');
Route::post('create-awb-number',[HtsUsersController::class, 'createAwbNumber'])->name('create-awb-number');
Route::get('delete-awb-details/{id}',[HtsUsersController::class, 'deleteAwbDetails'])->name('delete-awb-details');
Route::post('/updatePmtData',[HtsUsersController::class, 'updatePmtData'])->name('updatePmtData');
Route::post('/updatePersonalData',[HtsUsersController::class, 'updatePersonalData'])->name('updatePersonalData');
Route::post('/updateMoreInfoData',[HtsUsersController::class, 'updateMoreInfoData'])->name('updateMoreInfoData');
Route::match(['get', 'post'], 'providers',[HtsUsersController::class, 'provider_list'])->name('providers');
Route::get('add-provider/{id}',[HtsUsersController::class, 'addAgent'])->name('add-provider');
Route::match(['get', 'post'], 'customers',[HtsUsersController::class, 'customer_list'])->name('customers');
Route::get('add-customer/{id}',[HtsUsersController::class, 'addAgent'])->name('add-customer');
Route::match(['get', 'post'], 'vendors',[HtsUsersController::class, 'vendor_list'])->name('vendors');
Route::get('add-vendor/{id}',[HtsUsersController::class, 'addAgent'])->name('add-vendor');
Route::match(['get', 'post'], 'salespersons',[HtsUsersController::class, 'sales_list'])->name('salespersons');
Route::get('add-salesperson/{id}',[HtsUsersController::class, 'addAgent'])->name('add-salesperson');
Route::match(['get', 'post'], 'contacts',[HtsUsersController::class, 'contact_list'])->name('contacts');
Route::get('add-contact/{id}',[HtsUsersController::class, 'addAgent'])->name('add-contact');
Route::post('/getHtsRates',[HtsUsersController::class, 'getHtsRates'])->name('getHtsRates');

Route::get('/editAgent/{id}',[HtsUsersController::class, 'editAgent'])->name('editAgent');
Route::get('/viewAgent/{id}',[HtsUsersController::class, 'viewAgent'])->name('viewAgent');

Route::get('/view-details/{id}',[HtsUsersController::class, 'viewDetails'])->name('view-details');

// site settings
Route::get('/settings/site_settings','App\Http\Controllers\Admin\SettingController@site_settings')->name('site_settings');
Route::post('settings/save','App\Http\Controllers\Admin\SettingController@save')->name('save');
Route::get('settings/logo','App\Http\Controllers\Admin\SettingController@logo')->name('logo');
Route::post('settings/logosave','App\Http\Controllers\Admin\SettingController@logosave')->name('logosave');

Route::get('/adminlogout', 'App\Http\Controllers\Admin\LogoutController@adminlogout')->name('adminlogout');

