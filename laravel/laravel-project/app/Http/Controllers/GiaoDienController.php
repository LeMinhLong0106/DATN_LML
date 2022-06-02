<?php

namespace App\Http\Controllers;

use App\Models\CTHD;
use App\Models\DanhMuc;
use App\Models\HoaDon;
use App\Models\KhachHang;
use App\Models\MonAn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GiaoDienController extends Controller
{
    public function majestic()
    {
        // món chính mới nhất
        $monan_moi = MonAn::where('danhmuc', '=', 1)->orderBy('created_at', 'desc')->take(8)->get();
        // món đặc biệt
        $monan_db = MonAn::where('danhmuc', '=', 2)->get();
        return response()->json([
            'monan_db' => $monan_db,
            'monan_moi' => $monan_moi
        ]);
    }

    public function menu()
    {
        $danhmucs = DanhMuc::with(['monan'])->get();
        $monans = MonAn::where('tinhtrang', '=', 1)->with(['danhmucmonss'])->get();
        return response()->json([
            'danhmucs' => $danhmucs,
            'monans' => $monans
        ]);
    }

    public function detail($id)
    {
        $data = Monan::with(['danhmucmonss'])->find($id);
        return response()->json($data);
    }

    // public function search(Request $request)
    // {
    //     $keyword = $request->timkiem;
    //     $data = $keyword;
    //     $monans = MonAn::where('tenmonan', 'like', '%' . $keyword . '%')->get();
    //     return response()->json([
    //         'data' => $data,
    //         'monans' => $monans
    //     ]);
    // }

    public function addToCart($id)
    {
        $monans = MonAn::find($id);
        $cart = session()->get('cart');

        if (isset($cart[$id])) {
            // $cart[$id]['qty'] = $cart[$id]['qty'] + 1;
            $cart[$id]['qty'] = $cart[$id]['qty'] + 1;
        } else {
            $cart[$id] = [
                'tenmonan' => $monans->tenmonan,
                'gia' => $monans->gia,
                'qty' => 1,
                'ghichu' => null,
                'hinhanh' => $monans->hinhanh,
            ];
        }
        session()->put('cart', $cart);
        return response()->json([
            'code' => 200,
            'success' => 'Thêm thành công'
        ], 200);
        // dd(session()->get('cart'));
    }

    public function showCart()
    {
        $cart = session()->get('cart');
        // dd($cart);
        // return view('cart', compact('cart'));
        return response()->json([
            'cart' => $cart
        ]);
    }

    // public function deleteCart($id)
    // {
    //     $cart = session()->get('cart');
    //     unset($cart[$id]);
    //     session()->put('cart', $cart);
    //     return response()->json([
    //         'code' => 200,
    //         'success' => 'Xóa thành công'
    //     ], 200);
    // }

    // public function updateCart(Request $request)
    // {
    //     $cart = session()->get('cart');
    //     $cart[$request->id]['qty'] = $request->qty;
    //     session()->put('cart', $cart);
    //     return response()->json([
    //         'code' => 200,
    //         'success' => 'Cập nhật thành công'
    //     ], 200);
    // }

    public function checkout(Request $request)
    {
        $this->validate($request, [
            'hoten' => 'required',
            'sdt' => 'required|digits_between:10,11',
            'diachi' => 'required',
        ], [
            'hoten.required' => 'Vui lòng nhập tên khách hàng',
            'sdt.required' => 'Vui lòng nhập số điện thoại',
            'sdt.digits_between' => 'Số điện thoại phải từ 10 đến 11 số',
            'diachi.required' => 'Vui lòng nhập địa chỉ',
        ]);

        $order = new HoaDon;
        $order->khachhang_id = $request->idKH;
        $order->tongtien = $request->tongtien;
        $order->tinhtrang = 0;
        $order->ghichu = $request->ghichu;
        $order->hoten = $request->hoten;
        $order->diachi = $request->diachi;
        $order->sdt = $request->sdt;
        $order->loaihd_id = 1;
        $order->save();

        // tạo mới đơn hàng chi tiết
        $order_id = $order->id;
        $content = $request->cart;
        // dd($content);
        foreach ($content as $value) {
            $order_detail = new CTHD;
            $order_detail->hoadon_id = $order_id;
            $order_detail->tongtien = $value['quantity'] * $value['gia'];
            $order_detail->monan_id = $value['id'];
            $order_detail->soluong = $value['quantity'];
            $order_detail->ghichu = $value['note'];
            $order_detail->giaban = $value['gia'];
            $order_detail->save();
        }
        session()->forget('cart');

        return response()->json([
            'code' => 200,
            'success' => 'Thanh toán thành công'
        ], 200);
    }
}
