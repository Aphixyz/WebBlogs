<?php

use App\Http\Controllers\ActivePeopleController;
use App\Http\Controllers\admincontroller;
use App\Http\Controllers\peoplecontroller;
use App\Http\Controllers\singInController;
use App\Http\Controllers\registerController;
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

Route::get('/', [singInController::class, 'loginfrom'])->name('login.form');
Route::post('login', [singInController::class, 'login'])->name('login');

Route::get('/active/admin', [admincontroller::class, 'active'])->name('admin.active')->middleware('admin');

Route::get('/active/people', [peoplecontroller::class, 'active'])->name('people.active')->middleware('people');
Route::get('/form/getCreateBlod', [ActivePeopleController::class, 'Getform'])->name('people.getfrom')->middleware('people');
Route::post('/active/people/addblog', [ActivePeopleController::class, 'CreateBolg'])->name('people.add')->middleware('people');
Route::get('/form/getCreateBlod', [ActivePeopleController::class, 'getCategory'])->name('people.selectCategory')->middleware('people');

Route::get('register', [registerController::class, 'registerfrom'])->name('register');
Route::post('register', [registerController::class, 'register'])->name('register.into');




