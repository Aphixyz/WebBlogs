<?php

use App\Http\Controllers\SingInController;
use App\Http\Controllers\registerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ActivePeopleController;
use App\Http\Controllers\Peoplecontroller;
use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [SingInController::class, 'loginfrom'])->name('login.form');
Route::post('login', [SingInController::class, 'login'])->name('login');
Route::get('logout', [SingInController::class, 'logout'])->name('logout');
Route::get('register', [registerController::class, 'registerfrom'])->name('register');
Route::post('register', [registerController::class, 'register'])->name('register.into');


Route::get('/', [BlogController::class, 'index']);
Route::get('/blog/{id}', [BlogController::class, 'blogDetail'])->name('blogDetail');
Route::get('blog/category/{category_id}', [BlogController::class, 'searchCategory'])->name('searchCategory');
Route::get('/blog/writer/{user_id}', [BlogController::class, 'searchUser'])->name('searchUser');

// Admin Routes
Route::middleware('admin')->group(function () {
    Route::get('/active', [AdminController::class, 'active'])->name('admin.active');
    Route::get('/active/admin', [AdminController::class, 'getBlogForAdmin'])->name('admin.getblog');
    Route::get('/active/admin/addblog', [AdminController::class, 'adminCreateblog'])->name('admin.getfromblog');
    Route::get('/active/admin/addfrom', [AdminController::class, 'activeAddCategory'])->name('admin.formaddcategory');
    Route::post('/active/addmin/addfromcategory', [AdminController::class, 'createCategory'])->name('admin.addcategory');
    Route::post('/active/addmin/addfrom', [AdminController::class, 'CreateBolg'])->name('admin.addblod');
    Route::get('/active/addmin/category', [AdminController::class, 'getCategory'])->name('admin.getCategory');
    Route::get('/admin/categories/edit/{id}', [AdminController::class, 'editCategory'])->name('admin.editCategory');
    Route::put('/admin/categories/update/{id}', [AdminController::class, 'updateCategory'])->name('admin.updateCategory');
    Route::delete('/active/addmin/category/delete/{id}', [AdminController::class, 'deleteCategory'])->name('admin.deleteCategory');

    Route::get('/admin/blogs/edit/{id}', [AdminController::class, 'editData'])->name('admin.editData');
    Route::delete('/admin/blogs/delete/{id}', [AdminController::class, 'deleteData'])->name('admin.deleteData');
    Route::put('/admin/blogs/update/{id}', [AdminController::class, 'updateData'])->name('admin.updateData');
});

// People Routes
Route::middleware('people')->group(function () {
    Route::get('/active/people/from', [Peoplecontroller::class, 'getBlog'])->name('people.getfrom');
    // Route::get('/active/people/blog/json', [Peoplecontroller::class, 'getBlog'])->name('people.getblog');
    Route::post('/active/people/addblog', [ActivePeopleController::class, 'CreateBolg'])->name('people.add');
    Route::get('/active/people', [peoplecontroller::class, 'active'])->name('people.active');
    Route::get('/deleteData/{id}', [ActivePeopleController::class, 'deleteData'])->name('deleteData');
    Route::get('/editData/{id}', [ActivePeopleController::class, 'editData'])->name('editData');
    Route::put('/updateData/{id}', [ActivePeopleController::class, 'updateData'])->name('updateData');
});
