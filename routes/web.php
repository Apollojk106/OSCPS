<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\calledController;
use App\Http\Controllers\studentController;
use App\Http\Controllers\studentCourtController;

Route::get('/login', function () {
    return view('login');
});

Route::get('/', function () {
    return view('login');
});

Route::get('/teacher',[calledController::class, 'index']);
Route::post('/teacher',[calledController::class, 'index']);

Route::get('/student',[studentController::class, 'index']);
Route::post('/student',[studentController::class, 'index']);
Route::get('/student/{$andar}',[studentController::class, 'retornarTelaAndares']);
Route::post('/student/{id}', [studentController::class, 'retornarTelaAndares'])->name('student.floor');

Route::post('/student/court',[studentCourtController::class, 'index']);


