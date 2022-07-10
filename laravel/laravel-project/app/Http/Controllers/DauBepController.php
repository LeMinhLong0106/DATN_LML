<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class DauBepController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('checkQuyen');
    }
    public function listCook()
    {
        // $route = Route::currentRouteName();
        // $route = explode('.', $route);
        // $route = $route[0];
        // return $route;

        $cthd = DB::table('cthd')
            ->leftJoin('monan', 'cthd.monan_id', '=', 'monan.id')
            ->leftJoin('danhmucmon', 'monan.danhmuc', '=', 'danhmucmon.id')
            ->leftJoin('hoadon', 'cthd.hoadon_id', '=', 'hoadon.id')
            ->select(['cthd.*', 'monan.tenmonan', 'danhmucmon.tendm', 'danhmucmon.uutien', 'hoadon.ban_id', 'hoadon.id'])
            ->where('cthd.tinhtrang', 0)
            ->orderBy('hoadon.id')
            ->orderBy('danhmucmon.uutien')
            ->get();

        // return view('admin.order.giaodienDB', compact('data', 'cthd'));
        return response()->json([
            'cthd' => $cthd
        ], 200);
    }
}
