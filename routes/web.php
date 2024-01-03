<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::get('/', function () {
    return view('signin');
})->name('login');

Route::get('/Dashboard', function () {
    return view('dashboard');
})->name('Dashboard');

Route::get('/add-mahasiswa', function () {
    return view('add-mahasiswa');
})->name('add-mahasiswa');

Route::get('/edit-mahasiswa/{id}',  function () {
    return view('edit-mahasiswa');
})->name('edit-mahasiswa');

Route::get('/matakuliah',  function () {
    return view('matakuliah');
})->name('matakuliah');

Route::get('/add-matakuliah',  function () {
    return view('add-matakuliah');
})->name('add-matakuliah');

Route::get('/edit-matakuliah/{id}',  function () {
    return view('edit-matakuliah');
})->name('edit-matakuliah');

Route::get('/krs',  function () {
    return view('krs');
})->name('krs');

Route::get('/add-krs',  function () {
    return view('add-krs');
})->name('add-krs');

Route::get('/edit-krs/{id}',  function () {
    return view('edit-krs');
})->name('edit-krs');

Route::get('/detilkrs/{id}',  function () {
    return view('detilkrs');
})->name('detilkrs');

Route::get('/detilkrs/{idkrs}/{idmhs}',  function () {
    return view('detilkrs-mahasiswa');
})->name('detilkrs-mahasiswa');

Route::get('/add-detilkrs/{idkrs}/{idmhs}',  function () {
    return view('add-detilkrs-mahasiswa');
})->name('add-detilkrs-mahasiswa');

Route::get('/edit-detilkrs/{id}',  function () {
    return view('edit-detilkrs-mahasiswa');
})->name('edit-detilkrs-mahasiswa');

Route::get('/khs/{idmhs}', function () {
    return view('khs');
})->name('khs');

