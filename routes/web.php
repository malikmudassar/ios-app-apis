<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ReligionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
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

Route::get('/', [LoginController::class, 'index']);
Route::post('/adminLogin', [LoginController::class, 'adminLogin'])->name('adminLogin');

Route::middleware(['adminAuth'])->group(function () {
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/country', [CountryController::class, 'index'])->name('country');
Route::post('/countryTableList', [CountryController::class, 'countryTableList'])->name('countryTableList');
Route::post('/addEditCountry', [CountryController::class, 'addEditCountry'])->name('addEditCountry');
Route::post('/deleteCountryAction', [CountryController::class, 'deleteCountryAction'])->name('deleteCountryAction');
Route::get('/language', [LanguageController::class, 'index'])->name('language');
Route::post('/languageTableList', [LanguageController::class, 'languageTableList'])->name('languageTableList');
Route::post('/addEditLanguage', [LanguageController::class, 'addEditLanguage'])->name('addEditLanguage');
Route::post('/deleteLanguageAction', [LanguageController::class, 'deleteLanguageAction'])->name('deleteLanguageAction');
Route::get('/religion', [ReligionController::class, 'index'])->name('religion');
Route::post('/religionTableList', [ReligionController::class, 'religionTableList'])->name('religionTableList');
Route::post('/addEditReligion', [ReligionController::class, 'addEditReligion'])->name('addEditReligion');
Route::post('/deleteReligionAction', [ReligionController::class, 'deleteReligionAction'])->name('deleteReligionAction');
Route::get('/category', [CategoryController::class, 'index'])->name('category');
Route::post('/categoryTableList', [CategoryController::class, 'categoryTableList'])->name('categoryTableList');
Route::post('/addEditCategory', [CategoryController::class, 'addEditCategory'])->name('addEditCategory');
Route::post('/deleteCategoryAction', [CategoryController::class, 'deleteCategoryAction'])->name('deleteCategoryAction');
Route::get('/question', [QuestionController::class, 'index'])->name('question');
Route::post('/questionTableList', [QuestionController::class, 'questionTableList'])->name('questionTableList');
Route::post('/addEditQuestion', [QuestionController::class, 'addEditQuestion'])->name('addEditQuestion');
Route::post('/deleteQuestionAction', [QuestionController::class, 'deleteQuestionAction'])->name('deleteQuestionAction');
Route::get('/answer', [AnswerController::class, 'index'])->name('answer');
Route::post('/answerTableList', [AnswerController::class, 'answerTableList'])->name('answerTableList');
Route::post('/addEditAnswer', [AnswerController::class, 'addEditAnswer'])->name('addEditAnswer');
Route::post('/deleteAnswerAction', [AnswerController::class, 'deleteAnswerAction'])->name('deleteAnswerAction');
Route::post('/categoryDropdownFilter', [AnswerController::class, 'categoryDropdownFilter'])->name('categoryDropdownFilter');
Route::get('/changeID', [AnswerController::class, 'changeID']);
Route::get('/information', [InformationController::class, 'index'])->name('information');
Route::post('/infoTableList', [InformationController::class, 'infoTableList'])->name('infoTableList');
Route::post('/addEditInfo', [InformationController::class, 'addEditInfo'])->name('addEditInfo');
Route::post('/deleteInfoAction', [InformationController::class, 'deleteInfoAction'])->name('deleteInfoAction');
Route::get('/users', [UserController::class, 'usersList'])->name('users');
Route::post('/usersTableList', [UserController::class, 'usersTableList'])->name('usersTableList');
Route::post('/editUser', [UserController::class, 'editUser'])->name('editUser');
Route::get('/user-verification', [UserController::class, 'userVerificationList'])->name('user-verification');
Route::post('/usersVerificationTableList', [UserController::class, 'usersVerificationTableList'])->name('usersVerificationTableList');
Route::post('/isverified', [UserController::class, 'isverified'])->name('isverified');
});



