<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/questionnaires/create', [App\Http\Controllers\QuestionnaireController::class, 'create'])->name('create');

Route::post('/questionnaires', [App\Http\Controllers\QuestionnaireController::class, 'store'])->name('store');

Route::get('/questionnaires/{questionnaire}', [App\Http\Controllers\QuestionnaireController::class, 'show'])->name('show');

Route::get('/questionnaires/{questionnaire}/questions/create', [App\Http\Controllers\QuestionController::class, 'create'])->name('create');

Route::post('/questionnaires/{questionnaire}/questions', [App\Http\Controllers\QuestionController::class, 'store'])->name('store');

Route::delete('/questionnaires/{questionnaire}/questions/{question}', [App\Http\Controllers\QuestionController::class, 'destroy'])->name('destroy');

Route::delete('/questionnaires/{questionnaire}', [App\Http\Controllers\QuestionnaireController::class, 'destroy'])->name('deleteQuestionnaire');

Route::get('/surveys/{questionnaire}-{slug}', [App\Http\Controllers\SurveyController::class, 'show'])->name('show');

Route::post('/surveys/{questionnaire}-{slug}', [App\Http\Controllers\SurveyController::class, 'store'])->name('store');
