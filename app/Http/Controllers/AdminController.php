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


class AdminController extends Controller
{
    public function index()
    {
        return view('login/home');
    }

    // user
    public function action_user()
    {
        $data = ViewUser::get();
        return view("login/action_user", ["data"=>$data]);
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
        return view("admin/tambah_user");
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

    public function logout(Request $req)
    {
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        return redirect("login");
    }
}
