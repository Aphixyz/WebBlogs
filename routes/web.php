<?php
use App\Http\Controllers\SingInController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ActivePeopleController;
use App\Http\Controllers\PeopleController;

Route::get('/', [SingInController::class, 'loginform'])->name('login.form');
Route::post('login', [SingInController::class, 'login'])->name('login');

Route::get('register', [RegisterController::class, 'registerfrom'])->name('register');
Route::post('register', [RegisterController::class, 'register'])->name('register.into');


// Admin Routes
Route::middleware('admin')->group(function () {
    Route::get('/active/admin', [AdminController::class, 'active'])->name('admin.active');
});

// People Routes
Route::middleware('people')->group(function () {
    Route::get('/active/people/from', [ActivePeopleController::class, 'Getform'])->name('people.getfrom');
    Route::post('/active/people/addblog', [ActivePeopleController::class, 'CreateBolg'])->name('people.add');
    Route::post('/active/people/addblog', [ActivePeopleController::class, 'CreateBolg'])->name('people.add');
    Route::get('/active/people', [PeopleController::class, 'active'])->name('people.active');
});



