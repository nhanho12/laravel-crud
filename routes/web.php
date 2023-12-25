<?php

use App\Http\Controllers\AdminController\PostController;
use App\Http\Controllers\AuthController\LoginController;
use App\Http\Controllers\AuthController\RegisterController;
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
//get homepage UI
Route::get('/', function () {
    return view('index');
});

//get Login UI
Route::get('/login', function () {
    return view('auth/login');
})->name('login');
//handle login
Route::post('/login', [LoginController::class, 'handleFormLogin'])->name('form-login');
//handle logout
Route::get('/logout', [LoginController::class, 'handleFormLogout'])->name('logout');

//get Register UI
Route::get('/register', function () {
    return view('auth/register');
})->name('register');
//handle register 
Route::post('/register', [RegisterController::class, 'handleFormRegister'])->name('form-register');

//get admin UI and display all post's data
Route::get('/admin', [PostController::class, 'getAllPostData'])->name('admin-post');
//create post 
Route::post('/admin/create-post', [PostController::class, 'createPost'])->name('create-post');

//delete post by ID 
Route::get('/admin/delete-post/{id}', [PostController::class, 'deletePost'])->name('delete-post');

//edit and update by ID
Route::get('/admin/edit-post/{id}', [PostController::class, 'editPost'])->name('edit-post');
Route::post('/admin/update-post/{id}', [PostController::class, 'updatePost'])->name('update-post');

