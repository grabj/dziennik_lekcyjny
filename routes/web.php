<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//panel admina

Route::group(['middleware' => 'admin'], function(){
    Route::get('/admin/dashboard', [DashboardController::class, 'dashboard']);

    //działania na użytkownikach
    Route::get('/admin/users/list', [AdminController::class, 'listUsers'])->name('admin.users.list');
    Route::get('/admin/users/add', [AdminController::class, 'addUser'])->name('admin.users.add');
    Route::post("/admin/users/add", [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::get('/admin/users/edit/{id}', [AdminController::class, 'editUser']);
    Route::post('/admin/users/edit/{id}', [AdminController::class, 'updateUser']);
    Route::get('/admin/users/delete/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    Route::delete('/admin/users/delete/{id}', [AdminController::class, 'deleteUserReally']);

    //działania na ocenach
    Route::get('/admin/grades/list', [AdminController::class, 'listGrades'])->name('admin.grades.list');
    Route::get('/admin/grades/add', [AdminController::class, 'addGrade'])->name('admin.grades.add');
    Route::post("/admin/grades/add", [AdminController::class, 'storeGrade'])->name('admin.grades.store');
    Route::get('/admin/grades/delete/{id}', [AdminController::class, 'deleteGrade'])->name('admin.grades.delete');
    Route::delete('/admin/grades/delete/{id}', [AdminController::class, 'deleteGradeReally']);
});

//panel nauczyciela

Route::group(['middleware' => 'lecturer'], function(){
    Route::get('/lecturer/dashboard', [DashboardController::class, 'dashboard']);

    //działania na ocenach
    Route::get('/lecturer/grades/list', [LecturerController::class, 'listGrades'])->name('lecturer.grades.list');
    Route::get('/lecturer/grades/add', [LecturerController::class, 'addGrade'])->name('lecturer.grades.add');
    Route::post("/lecturer/grades/add", [LecturerController::class, 'storeGrade'])->name('lecturer.grades.store');
    Route::get('/lecturer/grades/list/invalid/{id}', [LecturerController::class, 'invalidGrade'])->name('lecturer.grades.invalid');
});

//panel ucznia

Route::group(['middleware' => 'student'], function(){
    Route::get('student/dashboard', [DashboardController::class, 'dashboard']);

    //działania na ocenach
    Route::get('/student/grades/list', [StudentController::class, 'listGrades'])->name('student.grades.list');
});


require __DIR__.'/auth.php';
