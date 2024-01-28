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
use App\RiwayatAbsensi;
use Illuminate\Support\Facades\DB;

Route::get('/', [LoginController::class, "index"])->name("/");
// Route::get("login", [LoginController::class, "index"])->name("login");
Route::get("login/create/", [LoginController::class, "create_account"])->name("login.create");
Route::post("/", [LoginController::class, "action_login"])->name("/");
Route::post("login/create", [LoginController::class, "create_user"])->name("login.create");
Route::get("reload-captcha", [LoginController::class, "reloadCaptcha"])->name("reload-captcha");

// admin dashboard
Route::middleware(["auth","CekStatus:admin"])->group(function(){
    // ROUTE MANAJEMEN USER
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
    Route::post("tambah/absensi", [AdminController::class, "aksi_presensi"])->name("tambah.absensi");
    Route::get("admin/cek_riwayat", [AdminController::class, "cek_riwayat"])->name("admin.cek_riwayat");
    Route::get("admin/download_riwayat", [AdminController::class, "download_riwayat"])->name("admin.download_riwayat");
});

// USER DASHBOARD
Route::middleware(["auth", "CekStatus:user"])->group(function(){
    // Tanpa middleware Cek Waktu
    Route::get("user/waktu_tutup", [UserController::class, "waktu_tutup"])->name("waktu_tutup");
    Route::get("user/waktu_buka", [UserController::class, "waktu_buka"])->name("waktu_buka");
    Route::get("user/set_update", [UserController::class, "set_update"])->name("user.set_update");
    Route::get("user/set_tutup", [UserController::class, "set_tutup"])->name("user.set_tutup");
    Route::get("user/logout", [UserController::class, "logout"])->name("user.logout");

    // Menggunakan middleware Cek Waktu
    Route::get("user", [UserController::class, "index"])->middleware("CekWaktu")->name("user");
    Route::post("user/simpan", [UserController::class, "simpan_user"])->middleware("CekWaktu")->name("user.simpan");
    Route::get("user/exists", [UserController::class, "user_exists"])->middleware("CekWaktu")->name("user.exists");
});
