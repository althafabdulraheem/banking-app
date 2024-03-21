<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{BankController,Auth\AuthController};
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

// auth routes

Route::get('/register',[AuthController::class,'register']);
Route::post('/register',[AuthController::class,'register_submit'])->name('register.submit');
Route::get('/logout',[AuthController::class,'logout']);
Route::get('/login',[AuthController::class,'login']);
Route::post('/login',[AuthController::class,'login_submit'])->name('login.submit');
// bank

Route::group(['middleware'=>'checkUser'],function()
{
    Route::get('/home',[BankController::class,'home'])->name('home');
    Route::get('/deposit',[BankController::class,'deposit'])->name('deposit.index');
    Route::post('/deposit',[BankController::class,'deposit_submit'])->name('deposit.submit');
    Route::get('/withdraw',[BankController::class,'withdraw'])->name('withdraw.index');
    Route::post('/withdraw',[BankController::class,'withdraw_submit'])->name('withdraw.submit');
    Route::get('/transfer',[BankController::class,'transfer'])->name('transfer.index');
    Route::post('/transfer',[BankController::class,'transfer_submit'])->name('transfer.submit');
    Route::get('/statement',[BankController::class,'statement'])->name('statement.index');
});
