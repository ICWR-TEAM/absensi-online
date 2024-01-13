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
use App\Http\Controllers\UserController;

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
    Route::get("admin/user/accept/{id}", [AdminController::class, "accept_user"])->name("admin.accept.id");
    Route::get("admin/user/delete/{id}", [AdminController::class, "delete_user"])->name("admin.user.delete");
    Route::get("tambah/user", [AdminController::class, "tambah_user"])->name("tambah.user");
    Route::post("import/excel/user", [AdminController::class, "import_excel_user"])->name("import.excel.user");
    Route::post("tambah/user", [AdminController::class, "tambah_user_manual"])->name("tambah.user");

    //absensi
    Route::get("tambah/absensi", [AdminController::class, "tambah_absensi"])->name("tambah.absensi");
    Route::post("tambah/absensi", [AdminController::class, "aksi_presensi"])->name("tamba.absensi");
});

// user dashboard
Route::middleware(["auth", "CekStatus:user"])->group(function(){
    Route::get("user", [UserController::class, "index"])->name("user");
    Route::get("user/logout", [UserController::class, "logout"])->name("user.logout");
});
