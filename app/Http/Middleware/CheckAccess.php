<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;

class CheckAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $db = DB::table("setting_absensi")->where("id", 1)->first();
        $waktu_awal = now();

        if($db->tutup_otomatis === "iya"){
            $pisah_tutup = explode(":", $db->waktu_tutup);
            $waktu_tutup = now()->setTime($pisah_tutup[0], $pisah_tutup[1], 0);
            if ($waktu_awal > $waktu_tutup) {
                return redirect()->intended("user/waktu_tutup")->with("error_tutup","waktu ditutup");
            }
        }

        if($db->buka_otomatis === "iya"){
            $pisah_buka = explode(":", $db->waktu_buka);
            $akses_waktu_awal = now()->setTime($pisah_buka[0], $pisah_buka[1], 0);
            if($waktu_awal < $akses_waktu_awal){
                return redirect()->intended("user/waktu_buka")->with("error_buka", "waktu belum dibuka");
            }
        }
        return $next($request);
    }
}
