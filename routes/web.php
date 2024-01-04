<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;

Route::get('/', [HomeController::class, "index"])->name("home");
Route::get("login", [LoginController::class, "index"])->name("login");
Route::get("login/create/", [LoginController::class, "create_account"])->name("login.create");
Route::post("login", [LoginController::class, "action_login"])->name("action_login");
Route::post("login/create", [LoginController::class, "create_user"])->name("login.create");

// admin dashboard
Route::middleware(["auth","CekStatus:admin"])->group(function(){
    Route::get("admin", [AdminController::class,"index"])->name("admin");
    Route::get("/admin/logout", [AdminController::class, "logout"])->name("admin.logout");
    Route::get("action/user", [AdminController::class, "action_user"])->name("action.user");
    Route::get("data/user", [AdminController::class, "json_user"])->name("data.user");
});

// siswa dashboard
