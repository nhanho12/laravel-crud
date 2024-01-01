<?php

use App\Http\Controllers\AdminController\PostController;
use App\Http\Controllers\AuthController\LoginController;
use App\Http\Controllers\AuthController\RegisterController;
use App\Http\Controllers\UserController\PostCreatedController;
use App\Http\Controllers\UserController\UserPostController;
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
    // return view('common.mail-post-created');
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

Route::prefix('/admin')->middleware(['admin'])->group(function () {
    //get admin UI and display all post's data
    Route::get('/', [PostController::class, 'getAllPostData'])->name('admin-post');
    //create post 
    Route::post('/create-post', [PostController::class, 'createPost'])->name('admin-create-post');

    //delete post by ID 
    Route::get('/delete-post/{id}', [PostController::class, 'deletePost'])->name('admin-delete-post');

    //edit and update by ID
    Route::get('/edit-post/{id}', [PostController::class, 'editPost'])->name('admin-edit-post');
    Route::post('/update-post/{id}', [PostController::class, 'updatePost'])->name('admin-update-post');
});

//----
//user
Route::prefix('/user')->group(function () {
    //get user UI and display all post's data
    Route::get('/', [UserPostController::class, 'getAllPostData'])->name('user-post');
    //create post
    Route::post('/create-post', [UserPostController::class, 'createPost'])->name('user-create-post');

    //delete post by ID 
    Route::get('/delete-post/{id}', [PostController::class, 'deletePost'])->name('user-delete-post');

    //edit and update by ID
    Route::get('/edit-post/{id}', [PostController::class, 'editPost'])->name('user-edit-post');
    Route::post('/update-post/{id}', [PostController::class, 'updatePost'])->name('user-update-post');
});
