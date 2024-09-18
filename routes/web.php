<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\calledController;

Route::get('/login', function () {
    return view('login');
});

Route::get('/', function () {
    return view('login');
});

Route::get('/teacher',[calledController::class, 'index']);
