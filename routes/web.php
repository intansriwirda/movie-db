<?php

use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

<<<<<<< HEAD
Route::get('/movie', function () {
    return view('movie');
});

Route::get('/home', [MovieController::class, 'homepage']);
=======
// Route::get('/movie', function () {
//     return view('movie');
// });
>>>>>>> 158de8d099be481d70fa82acd6f91591a168da3a

// Route::get('/movies', [MovieController::class, 'index']);


// Route::get('/movie',[MovieController::class,'create']);
// Route::resource('movie', MovieController::class);

// Route::resource('/kategori', CategoryController::class);

// Route::get('/home', function () {
//     return view('layouts.home');

Route::resource('movie', MovieController::class);

Route::resource('categories', CategoryController::class);

<<<<<<< HEAD

=======
Route::get('/home', [MovieController::class, 'homepage']);
>>>>>>> 158de8d099be481d70fa82acd6f91591a168da3a

