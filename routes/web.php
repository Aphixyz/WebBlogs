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

<<<<<<< Updated upstream
// Admin Routes
Route::middleware('admin')->group(function () {
    Route::get('/active/admin', [AdminController::class, 'active'])->name('admin.active');
});
=======
Route::get('/active/admin', [admincontroller::class, 'active'])->name('admin.active')->middleware('admin');

Route::get('/active/people', [peoplecontroller::class, 'active'])->name('people.active')->middleware('people');
Route::get('/form/getCreateBlod', [ActivePeopleController::class, 'Getform'])->name('people.getform')->middleware('people');
Route::post('/active/people/addblog', [ActivePeopleController::class, 'CreateBolg'])->name('people.add')->middleware('people');
Route::get('/form/getCreateBlods', [ActivePeopleController::class, 'getCategory'])->name('people.selectCategory')->middleware('people');

Route::get('register', [registerController::class, 'registerfrom'])->name('register');
Route::post('register', [registerController::class, 'register'])->name('register.into');
>>>>>>> Stashed changes

// People Routes
Route::middleware('people')->group(function () {
    Route::get('/active/people/from', [ActivePeopleController::class, 'Getform'])->name('people.getfrom');
    Route::post('/active/people/addblog', [ActivePeopleController::class, 'CreateBolg'])->name('people.add');
    Route::post('/active/people/addblog', [ActivePeopleController::class, 'CreateBolg'])->name('people.add');
    Route::get('/active/people', [PeopleController::class, 'active'])->name('people.active');
});



