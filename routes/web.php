<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionareController;

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

Route::get('/',[QuestionareController::class,'index']);
Route::post('/thankyou',[QuestionareController::class,'store'])->name('questionare.save');
//transaction_id s1 s2 s3 s4 s5
Route::get('/thankyou',[QuestionareController::class,'page_view'])->name('thankyou');



Route::get('/v1',[QuestionareController::class,'v1_index'])->name('v1_index');
Route::post('/v1',[QuestionareController::class,'v1_store'])->name('v1_store');
