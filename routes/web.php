<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;

Route::get('/', function () {
    return view('welcome');
});

/*
Route::get('/panel', function () {
    $vista = request()->get('vista');
    return view('admin.panel', compact('vista'));
})->name('panel');
*/