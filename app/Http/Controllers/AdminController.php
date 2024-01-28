<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\ViewUser;
use Session;
use Yajra\DataTables\Facades\DataTables;
use App\Imports\UserImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    function __construct(){
        //CEK HTTPS OR NO
        if (Request::capture()->header('x-forwarded-proto') !== 'https') {
            Session::flash("error_https", "error");
        }
    }

    private function cek_hari(){
        $db = DB::table("setting_absensi")->where("id", 1)->first();

        $waktu_awal = now();
        $pisah_tanggal_waktu = explode(" ", $db->updated_at);
        $pisah_tanggal = explode("-", $pisah_tanggal_waktu[0]);
        $cek_hari = now()->setDate($pisah_tanggal[0], $pisah_tanggal[1], $pisah_tanggal[2]);
        $hari_sekarang = now();
        if($hari_sekarang->isSameDay($cek_hari)){
            return true;
        }else{
            return false;
        }
    }

    public function index()
    {
        $data = [
            "cek_hari" => $this->cek_hari(),
            "data_admin" => DB::table("users")->where("role", "admin"),
            "data_user" => DB::table("users")->where("role", "user"),
            "data_user_in_table" => DB::table("users")->where("role", "user")->get(),
            "data_absensi" => DB::table("setting_absensi")->where("id", 1)->first(),
            "count_hadirRiwayatPresensi" => DB::table("riwayat_absensi")
                        ->rightJoin("users", "riwayat_absensi.id_user", "=", "users.id")
                        ->where("users.role", "=", "user")
                        ->where("riwayat_absensi.keterangan", "=", "Hadir")
                        ->select("users.name", "users.email", "riwayat_absensi.*")
                        ->orderByRaw("CASE WHEN riwayat_absensi.keterangan = 'hadir' THEN 1 ELSE 2 END")
                        ->count(),
            "count_allUsers" =>  DB::table("riwayat_absensi")
                        ->rightJoin("users", "riwayat_absensi.id_user", "=", "users.id")
                        ->where("users.role", "=", "user")
                        ->select("users.name", "users.email", "riwayat_absensi.*")
                        ->orderByRaw("CASE WHEN riwayat_absensi.keterangan = 'hadir' THEN 1 ELSE 2 END")
                        ->count(),
        ];
        // return $data["data_user"];
        return view('admin/home', $data);
    }

    // user
    public function action_user()
    {
        $data = ViewUser::get();
        return view("admin/action_user", ["data"=>$data, "cek_hari" => $this->cek_hari()]);
    }

    public function accept_user($id)
    {
        $db = DB::table("users")->where("id", $id)->update(["accept"=>"yes"]);
        if ($db) {
            Session::flash("berhasil","berhasil");
            return redirect("action/user/");
        }else {
            Session::flash("gagal", "gagal");
            return redirect("action/user/");
        }
    }

    public function delete_user($id)
    {
        $db = DB::table("users")->where("id", $id)->delete();
        if ($db) {
            Session::flash("berhasil_delete", "berhasil");
            return redirect("action/user/");
        }else {
            Session::flash("gagal_delete", "gagal");
            return redirect("action/user/");
        }
    }

    public function tambah_user()
    {
        return view("admin/tambah_user", ["cek_hari"=>$this->cek_hari()]);
    }

    public function import_excel_user(Request $req)
    {
        $req->validate([
            "file"=>[
                "required",
                function ($attribute, $value, $fail) {
                    $allowedTypes = ['csv', 'xls', 'xlsx'];
                    $extension = strtolower($value->getClientOriginalExtension());

                    if (!in_array($extension, $allowedTypes)) {
                        $fail("The $attribute must be a file of type: " . implode(', ', $allowedTypes) . ".");
                    }
                }
            ]
        ]);
        $file = $req->file("file");
        $nama_file = rand().$file->getClientOriginalName();
        $file->move("file",$nama_file);
        try {
            if(Excel::import(new UserImport, public_path('file/'.$nama_file))){
                File::delete(public_path("file/".$nama_file));
                Session::flash("berhasil_import", "berhasil");
                return redirect("tambah/user");
            }else {
                File::delete(public_path("file/".$nama_file));
                Session::flash("gagal_import", "gagal");
                return redirect("tambah/user");
            }
        } catch(\Exception $e) {
            File::delete(public_path("file/".$nama_file));
            Session::flash("gagal_import_duplicate", "Data duplicate, silahkan cek file ulang!");
            return redirect("tambah/user");
        }

    }

    public function tambah_user_manual(Request $req)
    {
        $req->validate([
            "nama"=>"required",
            "email"=>"required|email|min:3",
            "role"=>"required|in:admin,user",
            "password"=>"required|min:8"
        ]);
        if (DB::table("users")->where("email",$req->email)->exists()) {
            Session::flash("duplicate_email","gagal");
            return redirect("tambah/user");
        }else{
            $insert = DB::table("users")->insert([
                "email"=>$req->email,
                "name"=>$req->nama,
                "role"=>$req->role,
                "password"=>Hash::make($req->password),
                "accept"=>"yes",
                "created_at"=>now(),
                "updated_at"=>now()
            ]);
            if ($insert) {
                Session::flash("berhasil","berhasil");
                return redirect("tambah/user");
            }else{
                Session::flash("gagal","gagal");
                return redirect("tambah/user");
            }
        }
    }



//PRESENSI ACTION
    public function tambah_absensi()
    {
        $value_settingAbsensi = DB::table("setting_absensi")->where("id",1)->first();
        return view("admin/tambah_absensi")->with("value", $value_settingAbsensi);
    }

    public function aksi_presensi(Request $req)
    {
        $req->validate([
            "buka_atau_tutup"=>"required|in:buka,tutup",
            "buka_otomatis"=>"required|in:iya,tidak",
            "tutup_otomatis"=>"required|in:iya,tidak",
            "waktu_buka"=>$req->buka_otomatis == "iya" ? "required_if:buka_otomatis,iya" : "",
            "waktu_tutup"=>$req->tutup_otomatis == "iya" ? "required_if:tutup_otomatis,iya" : ""
        ]);

        $update = DB::table("setting_absensi")->where("id", 1)->update([
            "buka_atau_tutup"=>$req->buka_atau_tutup,
            "tutup_otomatis"=>$req->tutup_otomatis,
            "buka_otomatis"=>$req->buka_otomatis,
            "waktu_buka"=>$req->waktu_buka,
            "waktu_tutup"=>$req->waktu_tutup,
            "deskripsi"=>$req->deskripsi,
            "created_at"=>now(),
            "updated_at"=>now()
        ]);

        $drop_table_riwayat_absensi = DB::table("riwayat_absensi")->truncate();
        if ($update) {
            Session::flash("berhasil_update");
            return redirect("tambah/absensi");
        }else{
            Session::flash("gagal_update");
            return redirect("tambah/absensi");
        }

    }

    public function cek_riwayat()
    {
        $data = [
            "riwayat" =>
            DB::table("riwayat_absensi")
            ->rightJoin("users", "riwayat_absensi.id_user", "=", "users.id")
            ->where("users.role", "=", "user")
            ->select("users.name", "users.email", "riwayat_absensi.*")
            ->orderByRaw("CASE WHEN riwayat_absensi.keterangan = 'hadir' THEN 1 ELSE 2 END")
            ->get(),
            "cek_hari"=>$this->cek_hari()
        ];
        return view("admin/cek_riwayat", $data);
    }

    public function download_riwayat()
    {
        return Excel::download(new \App\Exports\RiwayatExport, "export.xlsx");
    }

    public function logout(Request $req)
    {
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        return redirect("/");
    }
}
