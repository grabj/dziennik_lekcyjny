<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;

Route::get('/welcome', function () {
    return view('welcome');
});

//Route::get('/subjects', [SubjectController::class, 'addSubject'])->name('subjects.addSubject');
Route::view('/subjects', 'subjects.addSubject');
//Route::post('/subjects', [SubjectController::class, 'addSubject']);

//Route::get('/subjects/editSubject', 'subjects.editSubject');

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

Route::group(['middleware' => 'admin'], function(){
    Route::get('admin/dashboard', function(){
        return view('admin.dashboard');
    });
});

Route::group(['middleware' => 'lecturer'], function(){
    Route::get('lecturer/dashboard', function(){
        return view('lecturer.dashboard');
    });
});

    Route::group(['middleware' => 'student'], function(){
        Route::get('student/dashboard', function(){
            return view('student.dashboard');
        });
});

//Route::get('/link',[YourController::class,'method'])->name('route.name')->middleware('admin');

require __DIR__.'/auth.php';
