<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;

Route::get('/welcome', function () {
    return view('welcome');
});

//Route::get('/subjects', [SubjectController::class, 'addSubject'])->name('subjects.addSubject');
//Route::view('subjects/addSubject', 'addSubject');
//Route::post('/subjects', [SubjectController::class, 'addSubject']);
//Route::get('/subjects/editSubject', 'subjects.editSubject');
//Route::resource('subjects', SubjectController::class);

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => 'admin'], function(){
    Route::get('/admin/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('/admin/users/list', [AdminController::class, 'listUsers'])->name('admin.users.list');
    Route::get('/admin/users/add', [AdminController::class, 'addUser'])->name('admin.users.add');
    Route::post("/admin/users/add", [AdminController::class, 'storeUser'])->name('admin.users.store');;
});

Route::group(['middleware' => 'lecturer'], function(){
    Route::get('lecturer/dashboard', [DashboardController::class, 'dashboard']);
});

Route::group(['middleware' => 'student'], function(){
    Route::get('student/dashboard', [DashboardController::class, 'dashboard']);
});


require __DIR__.'/auth.php';
