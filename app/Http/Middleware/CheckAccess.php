<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $pisah_waktu_tanggal = explode(" ", $db->updated_at);
        $pisah_tanggal = explode("-", $pisah_waktu_tanggal[0]);
        $pisah_waktu = explode(":", $pisah_waktu_tanggal[1]);
        $currentTime = now(); // Waktu saat ini
        $check_day = now()->setDate($pisah_tanggal[0], $pisah_tanggal[1], $pisah_tanggal[2]);
        // Tanggal penutupan: 31 Januari 2024, Jam 23:59:00

        if (DB::table("setting_absensi")->where("id", 1)->first()->buka_atau_tutup === "buka") {
            if ($currentTime->isSameDay($check_day)) {
                // Waktu saat ini dan waktu penutupan sama
                if($db->tutup_otomatis === "iya"){
                    $pisah_tutup = explode(":", $db->waktu_tutup);
                    $waktu_tutup = now()->setTime($pisah_tutup[0], $pisah_tutup[1], 0);
                    if ($currentTime > $waktu_tutup) {
                        return redirect()->intended("user/waktu_tutup")->with("error_tutup","waktu ditutup");
                    }
                }

                if($db->buka_otomatis === "iya"){
                    $pisah_buka = explode(":", $db->waktu_buka);
                    $akses_waktu_awal = now()->setTime($pisah_buka[0], $pisah_buka[1], 0);
                    if($currentTime < $akses_waktu_awal){
                        return redirect()->intended("user/waktu_buka")->with("error_buka", "waktu belum dibuka");
                    }
                }
            } else {
                // Jika tanggal sekarang tidak sama dengan tanggal penutupan
                return redirect()->intended("user/set_update")->with('error', 'Akses ditutup setelah tanggal 31 Januari 2024, jam 23:59.');
            }
        }else{
            return redirect()->intended("user/set_tutup")->with("error", "waktu ditutup");
        }


        return $next($request);
    }
}
