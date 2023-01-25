<?php
 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\PartnerInfoController;
use App\Http\Controllers\UserController;
 
 
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [CustomAuthController::class, 'index'])->name('login');
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 


Route::post('get-district', [PartnerInfoController::class, 'getDistrict']);
Route::post('get-district-list', [PartnerInfoController::class, 'getDistrictList']);

// Routes for creating new partners
Route::get('create-partner', [PartnerInfoController::class, 'create'])->name('create.partner');
Route::post('add-partner', [PartnerInfoController::class, 'store'])->name('add.partner');
Route::get('add-new-partner', [PartnerInfoController::class, 'newpartner'])->name('new.partner');

Route::get('/home', function () {
    return view('test');
});

// Routes for admin panel
Route::group(['middleware' => 'auth'], function () {
    Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
    Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom'); 
    Route::get('partner-settings', [PartnerInfoController::class, 'partnerSettings'])->name('partner.settings');
    Route::post('add-option', [PartnerInfoController::class, 'addOption'])->name('add.option');
    Route::get('dashboard', [CustomAuthController::class, 'dashboard'])->name('dashboard');
    Route::get('partner-info', [PartnerInfoController::class, 'index'])->name('partner.info');
    Route::get('partner-view/{id}', [PartnerInfoController::class, 'show'])->name('partner.view');
    Route::get('partner-edit/{id}', [PartnerInfoController::class, 'edit'])->name('partner.edit');
    Route::post('update-partner', [PartnerInfoController::class, 'update'])->name('partner.update');
    Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');
    Route::post('opsFilter', [PartnerInfoController::class, 'opsFilter']);
    Route::get('all-users', [UserController::class, 'index']);
    Route::get('edit-user/{id}', [UserController::class, 'editUser'])->name('edit.user');
    Route::post('update-user', [UserController::class, 'updateUser'])->name('update.user');
    Route::post('partner-state}', [PartnerInfoController::class, 'filterState'])->name('partner.state');
    Route::post('partner.orgtype', [PartnerInfoController::class, 'orgFilter'])->name('partner.orgtype');
    Route::post('partner-state-dist', [PartnerInfoController::class, 'stateDistFilter'])->name('partner.statedist');
    Route::post('partner-state-dist-org', [PartnerInfoController::class, 'stateDistOrgFilter'])->name('partner.stateDistOrg');
    Route::get('active-partners', [PartnerInfoController::class, 'activePartners'])->name('partners.active');
    Route::get('inactive-partners', [PartnerInfoController::class, 'inactivePartners'])->name('partners.inactive');
    Route::get('registered-partners', [PartnerInfoController::class, 'registeredPartners'])->name('partners.registered');
    Route::post('active', [PartnerInfoController::class, 'statusFilter'])->name('statusfilter');
    Route::get('about/{id}/{val}', function ($id, $val) {
        for ($i=1;$i<$id;$i++) {
            for ($j=0;$j<$i;$j++) {
                echo $val;
            }
            echo '</br>';
        }
    });
});