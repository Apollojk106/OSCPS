<?php

use Illuminate\Support\Facades\Route;

//rotas novas
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\StudentcalledController;
use App\Http\Controllers\StudentcontactsController;
use App\Http\Controllers\StudentcourtresevertationsController;
use App\Http\Controllers\StudentdashboardController;
use App\Http\Controllers\TeacherdashboardController;
use App\Http\Controllers\TeacherhistoryController;
use App\Http\Controllers\TeachernotificationController;
use App\Http\Controllers\TeacherconfigController;
use Illuminate\Auth\Events\Login;

//rotas basicas
Route::group(['middleware' => ['guest']], function () {
    Route::post('/login/student', [LoginController::class, 'Studentlogin'])->name('studentlogin');
    Route::post('/login/teacher', [LoginController::class, 'Teacherlogin'])->name('teacherlogin');
    Route::get('/login', [LoginController::class, 'Getlogin'])->name('login');
    Route::get('/', [LoginController::class, 'Getlogin'])->name('login');

    Route::get('/register', [LoginController::class, 'Getregister'])->name('register');
    Route::post('/register', [LoginController::class, 'StudentRegister'])->name('student.register');
});

// Rotas da sessão do aluno
Route::middleware(['role:user'])->group(function () {
    Route::get('/Student/dashboard', [StudentdashboardController::class, 'index'])->name('student.dashboard');
    Route::get('/', [StudentdashboardController::class, 'index'])->name('student.dashboard');

    Route::get('/Student/called', [StudentcalledController::class, 'index'])->name('student.called');
    Route::post('/Student/called', [StudentcalledController::class, 'store'])->name('post.student.called');

    Route::get('/Student/courtresevertations', [StudentcourtresevertationsController::class, 'index'])->name('student.courtresevertations');
    Route::post('/Student/courtresevertations', [StudentcourtresevertationsController::class, 'store'])->name('post.student.courtresevertations');

    Route::get('/Student/contacts', [StudentcontactsController::class, 'index'])->name('student.contacts');

    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

//rotas  da sesão de admin
Route::middleware(['role:admin'])->group(function () {
    Route::get('/Teacher/dashboard', [TeacherdashboardController::class, 'index'])->name('teacher.dashboard');
    Route::get('/', [TeacherdashboardController::class, 'index'])->name('teacher.dashboard');

    Route::get('/Teacher/history', [TeacherhistoryController::class, 'index'])->name('teacher.history');
    Route::get('/Teacher/history/filter', [TeacherhistoryController::class, 'filter'])->name('teacher.history.filter');

    Route::get('/Teacher/notification', [TeachernotificationController::class, 'index'])->name('teacher.notification');
    Route::patch('/called/{called}/updateStatus', [TeachernotificationController::class, 'updateStatus'])->name('called.updateStatus');
    Route::patch('/reservation/{reservation}/accept', [TeachernotificationController::class, 'accept'])->name('reservation.accept');
    Route::patch('/reservation/{reservation}/reject', [TeachernotificationController::class, 'reject'])->name('reservation.reject');

    Route::post('/Student/Edit', [TeacherconfigController::class, 'EditStudent'])->name('Student.Edit');
    Route::post('/location/Edit', [TeacherconfigController::class, 'EditLocation'])->name('Location.Edit');
    Route::post('/secretary/Edit', [TeacherconfigController::class, 'EditSecretary'])->name('Secretary.Edit');

    Route::get('/Teacher/config', [TeacherconfigController::class, 'index'])->name('teacher.config');
    Route::post('/Teacher/config/filter', [TeacherconfigController::class, 'filter'])->name('teacher.config.filter');
    Route::post('/Teacher/config/delete-class', [TeacherconfigController::class, 'deleteClass'])->name('teacher.config.delete_class');

    Route::post('/location/{id}/update', [TeacherconfigController::class, 'updateLocation'])->name('location.update');
    Route::get('/location/{id}/delete', [TeacherconfigController::class, 'destroyLocation'])->name('location.destroy');
    Route::post('/location/store', [TeacherconfigController::class, 'storeLocation'])->name('locations.store');

    Route::post('/student/{id}/update', [TeacherconfigController::class, 'updateStudent'])->name('student.update');
    Route::get('/student/{id}/delete', [TeacherconfigController::class, 'destroyStudent'])->name('student.destroy');
    Route::post('/student/store', [TeacherconfigController::class, 'storeStudent'])->name('students.store');
    Route::post('/students/import', [TeacherconfigController::class, 'importStudents'])->name('import.students');

    Route::post('/secretary/{id}/update', [TeacherconfigController::class, 'updateSecretary'])->name('secretary.update');
    Route::get('/secretary/{id}/delete', [TeacherconfigController::class, 'destroySecretary'])->name('secretary.destroy');
    Route::post('/secretary/store', [TeacherconfigController::class, 'storeSecretary'])->name('secretaries.store');

    //Route::get('/logout', [LoginController::class, 'Teacherlogout'])->name('logout');
    //Route::post('/logout', [LoginController::class, 'Teacherlogout'])->name('logout');
});
