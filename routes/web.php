<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\FolderController;
use Illuminate\Support\Facades\Auth;
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





Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function (){
    Route::get('/',[FileController::class,'index'])->name('file.index');
    Route::get('/file/create/{folderName}',[FileController::class,'Create'])->name('create.file');
    Route::post('file/store',[FileController::class,'store'])->name('upload.file');

//    file crud
    Route::get('/file/delete/{id}',[FileController::class,'delete'])->name('delete.file');


    Route::post('/folder/store',[\App\Http\Controllers\FolderController::class,'store'])->name('store.folder');
//    folder crud
    Route::get('/folder/delete/{id}',[FolderController::class,'delete'])->name('delete.folder');
    Route::get('/folder/edit/{id}',[FolderController::class,'edit'])->name('edit.folder');
    Route::put('/folder/update/{id}',[FolderController::class,'update'])->name('update.folder');

    Route::get('test',function (){
        $file = \App\Models\Folder::with('files')->get();
        dd($file->toArray());
    });
});
