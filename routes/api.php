<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SpotController;
use App\Http\Controllers\SystemProfileController;
use App\Http\Controllers\AvailabilitiesTimeSlotsController;
use App\Http\Controllers\InvitesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login')->name('login');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

//private apis
Route::middleware(['tokenAuth'])->group(function () {
    Route::post('/userProfile', [UserController::class, 'userProfile']);
    Route::post('/userProfileImage', [UserController::class, 'userProfileImage']);
    Route::post('/userQA', [UserController::class, 'userQA']);
    Route::get('/getUserData', [UserController::class, 'getUserData']);
    Route::post('/getOtherUserData', [UserController::class, 'getOtherUserData']);
    Route::post('/getSpotsWithinRadius', [SpotController::class, 'getSpotsWithinRadius']);
    Route::post('/spotsAvailabilities', [AvailabilitiesTimeSlotsController::class, 'spotsAvailabilities']);
    Route::get('/checkAvailability', [AvailabilitiesTimeSlotsController::class, 'checkAvailability']);
    Route::post('/userVerification', [UserController::class, 'userVerification']);
    Route::post('/testNotification', [UserController::class, 'testNotification']);
    Route::post('/searchFilter', [UserController::class, 'searchFilter']);
    Route::post('/sendInvites', [InvitesController::class, 'sendInvites']);
    Route::get('/getInvites', [InvitesController::class, 'getInvites']);
    Route::get('/acceptInvite/{invite_id}', [InvitesController::class, 'acceptInvite']);
});

// public apis
Route::get('/getProfileData', [SystemProfileController::class, 'getProfileData']);
Route::get('/getAvailabilitiesTimeSlots', [AvailabilitiesTimeSlotsController::class, 'getAvailabilitiesTimeSlots']);