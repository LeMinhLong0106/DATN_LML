<?php

namespace App\Http\Controllers;

use App\Models\CTHD;
use App\Models\HoaDon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BaoCaoController extends Controller
{
    public function index()
    {
        // $soluongmon = CTHD::select(['monan_id', 'created_at', DB::raw('sum(soluong) as total')])
        //     ->groupBy('monan_id', 'created_at')
        //     ->orderBy('total', 'desc')
        //     // ->take(2)
        //     ->get();
        $soluongmon = CTHD::with(['monanss'])->select(['monan_id', DB::raw('sum(soluong) as total')])
            ->groupBy('monan_id')
            ->orderBy('total', 'desc')
            ->take(8)
            ->get();

        $tongtienhomnay = HoaDon::select('created_at', DB::raw('sum(tongtien) as total'))
            ->groupBy('created_at')
            ->where('created_at', '=', date('Y-m-d'))
            ->where('loaihd_id', 0)->where('tinhtrang', 1)
            ->first('total');

        $tongtienhomqua = HoaDon::select('created_at', DB::raw('sum(tongtien) as total'))
            ->groupBy('created_at')
            ->where('created_at', '=', date('Y-m-d', strtotime('-1 date')))
            ->where('loaihd_id', 0)->where('tinhtrang', 1)
            ->first('total');

        $hd = HoaDon::select('created_at', DB::raw('sum(tongtien) as total'))
            ->groupBy('created_at')
            ->where('tinhtrang', 1)
            ->get();

        $hdtqcxl = HoaDon::where('loaihd_id', 0)->where('tinhtrang', 0)->count();
        $hdoncxl = HoaDon::where('loaihd_id', 1)->where('tinhtrang', 0)->count();

        $monanchuanau = CTHD::where('tinhtrang', 0)->count();

        $hdtq = HoaDon::where('loaihd_id', 0)->where('tinhtrang', 1)->get();
        $tttq = HoaDon::where('loaihd_id', 0)->where('tinhtrang', 1)->sum('tongtien');

        $songuoi = HoaDon::select(DB::raw('MONTH(created_at) as month'), DB::raw('sum(songuoi) as songuoi'))
            ->groupBy('month')
            ->where('tinhtrang', 1)
            ->get();

        $date_from = date('d-m-Y', strtotime('-1 month'));
        $date_to = date('d-m-Y');

        // if (request()->date_from && request()->date_to) {
        //     $date_from =  request()->date_from;
        //     $date_to = request()->date_to;
        //     $hdtq = HoaDon::where('loaihd_id', 0)->where('tinhtrang', 1)->whereBetween('created_at', [$date_from, $date_to])->get();
        //     $tttq = HoaDon::whereBetween('created_at', [$date_from, $date_to])->sum('tongtien');

        //     $soluongmon = CTHD::select(['monan_id', 'created_at'], DB::raw('sum(soluong) as total'))
        //         ->whereBetween('created_at', [$date_from, $date_to])
        //         ->groupBy('monan_id')
        //         ->orderBy('total', 'desc')
        //         ->get();
        //     // $soluongmon = CTHD::whereBetween('created_at', [$date_from, $date_to])->get();
        //     $songuoi = HoaDon::whereBetween('created_at', [$date_from, $date_to])->where('loaihd_id', 0)->sum('songuoi');
        // }


        return response()->json([
            'hd' => $hd,
            'hdtq' => $hdtq,
            'tttq' => $tttq,
            'hdtqcxl' => $hdtqcxl,
            'hdoncxl' => $hdoncxl,
            'monanchuanau' => $monanchuanau,
            'date_from' => $date_from,
            'date_to' => $date_to,
            'soluongmon' => $soluongmon,
            'songuoi' => $songuoi,
            'tongtienhomnay' => $tongtienhomnay,
            'tongtienhomqua' => $tongtienhomqua,
        ]);
    }
}
