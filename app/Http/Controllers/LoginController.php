<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return view("login/create");
    }

    public function action_login(Request $req)
    {
        $validated = $req->validate([
            "email"=>"required|email",
            "password"=>"required"
        ]);

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
