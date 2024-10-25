<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\calledController;
use App\Http\Controllers\studentController;
use App\Http\Controllers\studentCourtController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\userController;

use App\Http\Controllers\Auth\LoginController;


//rotas basicas
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/login', [LoginController::class, 'login'])->name('login');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', function () {return view('login');}); //rota do genshin pedo

//rotas da sessão do aluno

Route::post('/dashboard',[studentController::class, 'dashboardview'])->name("Dashboard");

Route::get('/dashboard',[studentController::class, 'dashboardview'])->name("Dashboard");
Route::get('/called',[studentController::class, 'calledview'])->name("Called");
Route::get('/courtresevertations',[studentController::class, 'courtresevertationsview'])->name("Courtreservertations");
Route::get('/contacts',[studentController::class, 'contactsview'])->name("contacts");

Route::post('/called',[studentController::class, 'calledpost'])->name("Post.Called");
Route::post('/courtresevertations',[studentController::class, 'courtresevertationspost'])->name("Post.Courtreservertations");

//rotas do responsavel



//antigas rotas de teste
Route::get('/teacher',[calledController::class, 'index']);
Route::post('/teacher',[calledController::class, 'index']);

Route::get('/student',[studentController::class, 'index']);
Route::post('/student',[studentController::class, 'index']);
Route::get('/student/{$andar}',[studentController::class, 'retornarTelaAndares']);
Route::post('/student/{id}', [studentController::class, 'retornarTelaAndares'])->name('student.floor');

Route::post('/student/court',[studentCourtController::class, 'index']);


