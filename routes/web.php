<?php
use App\Http\Controllers\SingInController;
use App\Http\Controllers\registerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ActivePeopleController;
use App\Http\Controllers\Peoplecontroller;

Route::get('/', [SingInController::class, 'loginfrom'])->name('login.form');
Route::post('login', [SingInController::class, 'login'])->name('login');

Route::get('register', [registerController::class, 'registerfrom'])->name('register');
Route::post('register', [registerController::class, 'register'])->name('register.into');


// Admin Routes
Route::middleware('admin')->group(function () {
    Route::get('/active/admin', [AdminController::class, 'active'])->name('admin.active');
});

// People Routes
Route::middleware('people')->group(function () {
    Route::get('/active/people/from', [ActivePeopleController::class, 'Getform'])->name('people.getfrom');
    Route::post('/active/people/addblog', [ActivePeopleController::class, 'CreateBolg'])->name('people.add');
    Route::post('/active/people/addblog', [ActivePeopleController::class, 'CreateBolg'])->name('people.add');
    Route::get('/active/people', [peoplecontroller::class, 'active'])->name('people.active');
});



