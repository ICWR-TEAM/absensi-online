<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\ViewUser;
use Session;
use Yajra\DataTables\Facades\DataTables;


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

    public function tambah_user()
    {
        return view("login/tambah_user");
    }

    public function logout(Request $req)
    {
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        return redirect("login");
    }
}
