<?php

namespace App\Http\Controllers;

use App\Models\Ban;
use App\Models\CTHD;
use App\Models\HoaDon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// use Illuminate\Support\Facades\Auth;

class HoaDonController extends Controller
{
    public function indexHDTQ()
    {
        $data = HoaDon::where('loaihd_id', 0)->get();
        // return view('admin.hdtaiquay.index', compact('data', 'cthd'));
        return response()->json([
            'data' => $data,
        ]);
    }

    public function showHDTQ($hDTaiQuay)
    {
        $data = HoaDon::find($hDTaiQuay);
        $cthd = CTHD::where('hoadon_id', $hDTaiQuay)->with(['monanss'])
        ->get();
        return response()->json([
            'data' => $data,
            'cthd' => $cthd,
            'tong' => $data->tongtien
        ]);
    }

    public function thanhtoanhdtq($id)
    {
        $user = Auth::user();
        $sale = HoaDon::find($id);
        $sale->tinhtrang = 1;
        $sale->nhanvien_tn = $user->name;
        $sale->save();
        $tabs = Ban::find($sale->ban_id);
        $tabs->tinhtrang = 0;
        $tabs->save();
        return response()->json();
    }

    public function thanhtoanon($id)
    {
        $user = Auth::user();
        $sale = HoaDon::find($id);
        $sale->tinhtrang = 1;
        $sale->nhanvien_tn = $user->name;
        $sale->save();
        return $this->indexHDO();
    }

    public function showReceipt($id)
    {
        $sale = HoaDon::find($id);
        $cthd = CTHD::where('hoadon_id', $id)->get();
        return response()->json([
            'sale' => $sale,
            'cthd' => $cthd,
            'tong' => $sale->tongtien
        ]);
        // return view('admin.hdtaiquay.showReceipt', compact('sale', 'cthd'));
    }

    public function deleteHD($hDTaiQuay)
    {
        $data = HoaDon::find($hDTaiQuay);
        $data->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Xóa thành công'
        ]);
    }

    public function indexHDO()
    {
        $data = HoaDon::where('loaihd_id',1)->get();
        return response()->json([
            'data' => $data,
        ]);
    }

    public function showHDO($hDOnline)
    {
        $data = HoaDon::find($hDOnline);
        $cthd = CTHD::where('hoadon_id', $hDOnline)->with(['monanss'])->get();
        return response()->json([
            'data' => $data,
            'cthd' => $cthd,
            'tong' => $data->tongtien
        ]);
    }

    public function deleteHDO($hDOnline)
    {
        $data = HoaDon::find($hDOnline);
        $data->delete();
        return redirect()->back();
    }
}
