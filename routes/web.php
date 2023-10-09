<?php

use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/',[FileController::class,'index'])->name('file.index');
Route::get('/file/create/{folderName}',[FileController::class,'Create'])->name('create.file');
Route::post('file/store',[FileController::class,'store'])->name('upload.file');
Route::post('/folder/store',[\App\Http\Controllers\FolderController::class,'store'])->name('store.folder');
