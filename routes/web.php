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
Route::group(['middleware' => ['auth']], function () {
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
//Route::group(['middleware' => ['auth:admin']], function () {
    Route::get('/Teacher/dashboard', [TeacherdashboardController::class, 'index'])->name('teacher.dashboard');
    Route::get('/', [TeacherdashboardController::class, 'index'])->name('teacher.dashboard');

    Route::get('/Teacher/history', [TeacherhistoryController::class, 'index'])->name('teacher.history');

    Route::get('/Teacher/notification', [TeachernotificationController::class, 'index'])->name('teacher.notification');

    Route::get('/logout', [LoginController::class, 'Teacherlogout'])->name('logout');
    Route::post('/logout', [LoginController::class, 'Teacherlogout'])->name('logout');
//}); 