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
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('checkQuyen');
    }

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
        $detail = CTHD::where('hoadon_id', $id)->get();
        $detail->each(function ($item) {
            $item->update([
                'tinhtrang' => 1
            ]);
        });
        $sale->tinhtrang = 1;
        $sale->nhanvien_tn = $user->hoten;
        $sale->save();
        $tabs = Ban::find($sale->ban_id);
        $tabs->tinhtrang = 0;
        $tabs->save();
        return response()->json();
    }

    public function getHDKD()
    {
        $data = HoaDon::where('loaihd_id', 0)->where('tinhtrang', 0)->whereNotNull('thoigianden')->get();
        return response()->json($data);
    }

    public function khdattruoc(Request $request)
    {
        $this->validate($request, [
            'hoten' => 'required',
            'sdt' => 'required|numeric|digits_between:10,11',
            'thoigianden' => 'required',
        ], [
            'hoten.required' => 'Nhập họ tên',
            'sdt.required' => 'Nhập số điện thoại',
            'sdt.numeric' => 'Số điện thoại phải là số',
            'sdt.digits_between' => 'Số điện thoại phải từ 10 đến 11 số',
            'thoigianden.required' => 'Chọn thời gian đến',
        ]);
        $user = Auth::user();
        $ban = Ban::find($request->id);
        $ban->tinhtrang = 2;
        $ban->save();
        $hoadon = HoaDon::create([
            'hoten' => $request->hoten,
            'sdt' => $request->sdt,
            'ghichu' => $request->ghichu,
            'songuoi' => $request->songuoi,
            'thoigianden' => $request->thoigianden,
            'ban_id' => $request->id,
            'loaihd_id' => 0,
            'nhanvien_tn' => $user->hoten,
            'tongtien' => 0,
            'tinhtrang' => 0,
        ]);
        return response()->json([
            'hoadon' => $hoadon,
        ]);
    }

    public function thanhtoanon($id)
    {
        $user = Auth::user();
        $sale = HoaDon::find($id);
        $sale->tinhtrang = 1;
        $sale->nhanvien_tn = $user->hoten;
        $sale->save();

        $detail = CTHD::where('hoadon_id', $id)->get();
        $detail->each(function ($item) {
            $item->update([
                'tinhtrang' => 1
            ]);
        });

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
        $data = HoaDon::where('loaihd_id', 1)->get();
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
        return response()->json([
            'message' => 'Xóa thành công'
        ]);
    }
}
