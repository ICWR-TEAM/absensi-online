<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\RiwayatAbsensi;
use Session;

class UserController extends Controller
{
    public function index()
    {
        if (DB::table("riwayat_absensi")->where("id_user", Auth::user()->id)->exists()) {
            return redirect("user/exists");
        }else{
            $value = DB::table("users")->where("email", Auth::user()->email)->first();
            return view("user/index")->with("value",$value);
        }
    }

    public function simpan_user(Request $req)
    {
        $req->validate([
            "image"=>"required"
        ]);
        $req_db = [
            "id_user"=>Auth::user()->id,
            "nama"=>Auth::user()->name,
            "email"=>Auth::user()->email,
            "keterangan"=>"Hadir",
            "deskripsi"=>$req->deskripsi,
            "gambar"=>$req->image,
            "created_at"=>now(),
            "updated_at"=>now()
        ];
        if (DB::table("riwayat_absensi")->where("id_user", Auth::user()->id)->exists()) {
            redirect("user/exists");
        }else{
            $insert = DB::table("riwayat_absensi")->insert($req_db);
            if ($insert) {
                Session::flash("berhasil");
                return redirect("user");
            }else{
                Session::flash("gagal");
                return redirect("user");
            }
        }
    }

    public function user_exists()
    {
        if (DB::table("riwayat_absensi")->where("id_user", Auth::user()->id)->exists()) {
            $data = DB::table("riwayat_absensi")->where("id_user", Auth::user()->id)->first();
            return view("user/exists", ["cek_hari" => $data->updated_at]);
        }else{
            return redirect("user");
        }
    }

    public function waktu_buka()
    {
        $db = DB::table("setting_absensi")->where("id", 1)->first();
        $waktu_awal = now();
        $pisah_buka = explode(":", $db->waktu_buka);
        $akses_waktu_awal = now()->setTime($pisah_buka[0], $pisah_buka[1], 0);
        if($waktu_awal > $akses_waktu_awal || $db->buka_otomatis === "tidak"){
            return redirect()->intended("user");
        }
        $data = DB::table("setting_absensi")->where("id", 1)->first()->waktu_buka;
        return view("user/waktu_buka", ["cek_hari" => $data]);
    }

    public function waktu_tutup()
    {
        $db = DB::table("setting_absensi")->where("id", 1)->first();
        $waktu_awal = now();
        $pisah_tutup = explode(":", $db->waktu_tutup);
        $akses_waktu_tutup = now()->setTime($pisah_tutup[0], $pisah_tutup[1], 0);
        if($waktu_awal < $akses_waktu_tutup || $db->tutup_otomatis === "tidak"){
            return redirect()->intended("user");
        }
        $data = DB::table("setting_absensi")->where("id", 1)->first()->waktu_tutup;
        return view("user/waktu_tutup", ["cek_hari" => $data]);
    }

    public function set_update()
    {
        $db = DB::table("setting_absensi")->where("id", 1)->first();
        $waktu_awal = now();
        $pisah_tanggal_waktu = explode(" ", $db->updated_at);
        $pisah_tanggal = explode("-", $pisah_tanggal_waktu[0]);
        $cek_hari = now()->setDate($pisah_tanggal[0], $pisah_tanggal[1], $pisah_tanggal[2]);
        $hari_sekarang = now();
        if($hari_sekarang->isSameDay($cek_hari)){
            return redirect()->intended("user");
        }
        return view("user/waktu_update");
    }

    public function set_tutup()
    {
        $db = DB::table("setting_absensi")->where("id", 1)->first();
        if ($db->buka_atau_tutup === "buka") {
            return redirect()->intended("user");
        }
        return view("user/set_tutup");
    }

    public function logout(Request $req)
    {
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        return redirect("/");
    }
}
