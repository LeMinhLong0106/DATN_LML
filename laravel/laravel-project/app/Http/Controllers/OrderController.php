<?php

namespace App\Http\Controllers;

use App\Models\Ban;
use App\Models\CTHD;
use App\Models\HoaDon;
use App\Models\MonAn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(CTHD::with(['monanss'])->get());
    }

    public function giaodienDB()
    {

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    public function table_status()
    {
        $data = HoaDon::all();
        $monans = MonAn::all();
        $bans = Ban::all();
        $hd = HoaDon::all();
        // return view('admin.order.table_status', compact('data', 'bans', 'monans', 'hd'));
        return response()->json([
            'data' => $data,
            'bans' => $bans,
            'monans' => $monans,
            'hd' => $hd
        ], 200);
    }


    public function getSaleDetails($table_id) //nhấn vào bàn thì hiển thị danh sách món ăn
    {
        $sale = HoaDon::where('ban_id', $table_id)->where('tinhtrang', 0)->first(); //lấy hóa đơn có trạng thái 0     

        if ($sale) {
            $sale_id = $sale->id;
            $html =  $this->xyz($sale_id);
        } else {
            $html = null;
        }
        return $html;
    }

    public function orderFood(Request $request)
    {
        $id_mon = $request->product_name;
        $table_id = $request->table_id;
        $people_quantity = $request->people_quantity;

        $monans = MonAn::find($id_mon);

        $sale = HoaDon::where('ban_id', $table_id)->where('tinhtrang', 0)->first();
        if (!$sale) {
            $user = Auth::user();
            $sale = new HoaDon;
            $sale->ban_id = $table_id;
            $sale->nhanvien_id = $user->name;
            $sale->songuoi = $people_quantity;
            $sale->save();
            $sale_id = $sale->id;
            // lưu bàn
            $table = Ban::find($table_id);
            $table->tinhtrang = 1; //đã đặt
            $table->save();
        } else {
            $sale_id =  $sale->id;
        }
        // lưu chi tiết hóa đơn
        $saleDetail = new CTHD;
        $saleDetail->hoadon_id = $sale_id;
        $saleDetail->monan_id = $monans->id;
        $saleDetail->giaban = $monans->gia;
        $saleDetail->soluong = $request->product_quantity;
        $saleDetail->tongtien = $request->product_quantity * $monans->gia;
        $saleDetail->ghichu = $request->product_note;
        $saleDetail->save();
        // tổng tiền trong hóa đơn
        $sale->tongtien = $sale->tongtien + $saleDetail->tongtien; //
        $sale->save();
        $html =  $this->xyz($sale_id);
        return $html;
    }

    private function xyz($sale_id)
    {
        // hiển thị bên chi tiết
        $saleDetails =  CTHD::where('hoadon_id', $sale_id)->with(['monanss'])->get();
        // dd($saleDetails);
        $sale_tp = HoaDon::find($sale_id);
        return response()->json([
            'saleDetails' => $saleDetails,
            'tong' => $sale_tp->tongtien
        ], 200);
    }


    public function confirmOrder(Request $request)
    {
        $id_cthd = $request->id;
        $cthd = CTHD::find($id_cthd);
        $cthd->tinhtrang = 1;
        $cthd->save();
        $id_hd = $cthd->hoadon_id;
        $html =  $this->xyz($id_hd);
        return  $html;
    }

    public function deleteOrder(Request $request)
    {
        $id_cthd = $request->id;
        $cthd = CTHD::find($id_cthd);

        $id_hd = $cthd->hoadon_id;
        $cthd->delete(); //xoa cthd

        $hd = HoaDon::find($id_hd);
        $hd->tongtien = $hd->tongtien - ($cthd->giaban * $cthd->soluong);
        $hd->save(); //luu hd
        $html =  $this->xyz($id_hd);
        return  $html;
    }


    public function updateSoluong(Request $request)
    {
        // dd($request->all());
        $id_cthd = $request->id;
        $cthd = CTHD::find($id_cthd);

        $cthd->soluong = $request->soluong;
        $cthd->tongtien = $request->soluong * $cthd->giaban;
        $cthd->save();
        $tong = CTHD::where('hoadon_id', $cthd->hoadon_id)->sum('tongtien');

        $id_hd = $cthd->hoadon_id;
        $hd = HoaDon::find($id_hd);

        $hd->tongtien = $tong;

        $hd->save();

        $html =  $this->xyz($id_hd);
        return  $html;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }
}
