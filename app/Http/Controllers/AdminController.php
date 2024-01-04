<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\ViewUser;
// use App\User;
use Session;
// use DataTables;
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

    public function json_user()
    {
        // return DataTables::of(DB::table('users')->get())->make(true);
        // return json_encode(\App\User::all());
        // $data = \App\User::all();
        // return $data->toJson();
        // dd($data);
        // $data = ViewUser::latest()->get();
        // dd($data);
        // return DataTables::of($data)->addIndexColumn()->make(true);

        // return ViewUser::get()->toJson();
    }

    public function logout(Request $req)
    {
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        return redirect("login");
    }
}
