<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SpotController;
use App\Http\Controllers\SystemProfileController;

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
    Route::post('/getSpotsWithinRadius', [SpotController::class, 'getSpotsWithinRadius']);
});

// public apis
Route::get('/getProfileData', [SystemProfileController::class, 'getProfileData']);