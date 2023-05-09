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
Route::post('/adminLogin', [LoginController::class, 'adminLogin']);

Route::middleware(['adminAuth'])->group(function () {
Route::get('/logout', [LoginController::class, 'logout']);
Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/country', [CountryController::class, 'index']);
Route::post('/countryTableList', [CountryController::class, 'countryTableList']);
Route::post('/addEditCountry', [CountryController::class, 'addEditCountry']);
Route::post('/deleteCountryAction', [CountryController::class, 'deleteCountryAction']);
Route::get('/language', [LanguageController::class, 'index']);
Route::post('/languageTableList', [LanguageController::class, 'languageTableList']);
Route::post('/addEditLanguage', [LanguageController::class, 'addEditLanguage']);
Route::post('/deleteLanguageAction', [LanguageController::class, 'deleteLanguageAction']);
Route::get('/religion', [ReligionController::class, 'index']);
Route::post('/religionTableList', [ReligionController::class, 'religionTableList']);
Route::post('/addEditReligion', [ReligionController::class, 'addEditReligion']);
Route::post('/deleteReligionAction', [ReligionController::class, 'deleteReligionAction']);
Route::get('/category', [CategoryController::class, 'index']);
Route::post('/categoryTableList', [CategoryController::class, 'categoryTableList']);
Route::post('/addEditCategory', [CategoryController::class, 'addEditCategory']);
Route::post('/deleteCategoryAction', [CategoryController::class, 'deleteCategoryAction']);
Route::get('/question', [QuestionController::class, 'index']);
Route::post('/questionTableList', [QuestionController::class, 'questionTableList']);
Route::post('/addEditQuestion', [QuestionController::class, 'addEditQuestion']);
Route::post('/deleteQuestionAction', [QuestionController::class, 'deleteQuestionAction']);
Route::get('/answer', [AnswerController::class, 'index']);
Route::post('/answerTableList', [AnswerController::class, 'answerTableList']);
Route::post('/addEditAnswer', [AnswerController::class, 'addEditAnswer']);
Route::post('/deleteAnswerAction', [AnswerController::class, 'deleteAnswerAction']);
Route::post('/categoryDropdownFilter', [AnswerController::class, 'categoryDropdownFilter']);
Route::get('/changeID', [AnswerController::class, 'changeID']);
Route::get('/information', [InformationController::class, 'index']);
Route::post('/infoTableList', [InformationController::class, 'infoTableList']);
Route::post('/addEditInfo', [InformationController::class, 'addEditInfo']);
Route::post('/deleteInfoAction', [InformationController::class, 'deleteInfoAction']);
});



