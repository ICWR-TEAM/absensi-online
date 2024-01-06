<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Validation\Rules\Password;
use Session;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->role === "admin") {
                return redirect()->intended("admin");
            }elseif (Auth::user()->role === "user") {
                return redirect()->intended("user");
            }
        }

        return view("login/index");
    }
    public function create_account()
    {
        if (Auth::check()) {
            if (Auth::user()->role === "admin") {
                return redirect()->intended("admin");
            }elseif (Auth::user()->role === "user") {
                return redirect()->intended("user");
            }
        }
        return view("login/create");
    }

    public function action_login(Request $req)
    {
        $validated = $req->validate([
            "email"=>"required|email",
            "password"=>"required"
        ]);

        if (DB::table("users")->where("email", $req->email)->value('accept')==="no") {
            Session::flash("not_acc","salah");
            return redirect("login");
        }else{
            if (Auth::Attempt($validated)) {
                $req->session()->regenerate();
                if (Auth::user()->role === "admin") {
                    return redirect()->intended("admin");
                }elseif(Auth::user()->role === "user"){
                    return redirect()->intended("user");
                }
            }else {
                Session::flash("error","password salah");
                return redirect("login");
            }
        }
    }

    public function create_user(Request $req)
    {
        $validated = $req->validate([
            "nama"=>"required",
            "email"=>"required|email|min:3",
            "password"=>[
                "min:8",
                "required_with:password_repeat",
                "same:password_repeat",
                "regex:/[a-z]/",
                "regex:/[A-Z]/",
                "regex:/[0-9]/",
                "regex:/[@$!'%*#?&]/"
            ],
            "password_repeat"=>"required|min:8"
        ]);
        if ($validated) {
            if (DB::table("users")->where("email",$req->email)->exists()) {
                Session::flash("email_exists", "gagal");
                return redirect("login/create");
            }else{
                $insert = DB::table("users")->insert([
                    "email"=>$req->email,
                    "name"=>$req->nama,
                    "role"=>"user",
                    "password"=>Hash::make($req->password),
                    "accept"=>"no"
                ]);
                if ($insert) {
                    Session::flash("berhasil", "berhasil");
                    return redirect("login/create");
                }else{
                    Session::flash("gagal","gagal");
                    return redirect("login/create");
                }
            }
        }
    }
}
