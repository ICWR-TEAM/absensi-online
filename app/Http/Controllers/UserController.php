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
            redirect("user/exists");
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
        return view("user/exists");
    }

    public function logout(Request $req)
    {
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        return redirect("login");
    }
}
