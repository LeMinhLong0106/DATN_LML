<?php

namespace App\Http\Controllers;

use App\Models\CTHD;
use App\Models\DanhMuc;
use App\Models\HoaDon;
use App\Models\KhachHang;
use App\Models\MonAn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class GiaoDienController extends Controller
{

    public function register(Request $request)
    {
        $data = $request->validate([
            'tenkh' => 'required|string|max:40',
            'email' => 'required|string|email|max:100|unique:khachhang',
            'sdt' => 'required|numeric|digits_between:10,11',
            'diachi' => 'required|string|max:100',
            'matkhau' => 'required|string|min:6',
        ], [
            'tenkh.required' => 'Nhập tên khách hàng',
            'tenkh.max' => 'Tên khách hàng không được vượt quá 40 ký tự',
            'email.required' => 'Nhập email',
            'email.email' => 'Email không hợp lệ',
            'email.max' => 'Email không được vượt quá 100 ký tự',
            'email.unique' => 'Email đã tồn tại',
            'sdt.required' => 'Nhập số điện thoại',
            'sdt.digits_between' => 'Số điện thoại phải có từ 10 đến 11 số',
            'diachi.required' => 'Nhập địa chỉ',
            'diachi.max' => 'Địa chỉ không được vượt quá 100 ký tự',
            'matkhau.required' => 'Nhập mật khẩu',
            'matkhau.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
        ]);
        $user = KhachHang::create([
            'tenkh' => $data['tenkh'],
            'email' => $data['email'],
            'sdt' => $data['sdt'],
            'diachi' => $data['diachi'],
            'google_id' => '',
            'matkhau' => Hash::make($data['matkhau']),
        ]);

        return response()->json(
            [
                'message' => 'Đăng ký thành công',
                'customer' => $user,
            ],
        );
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|string|email|max:100',
            'matkhau' => 'required|string|min:6',
        ], [
            'email.required' => 'Bạn chưa nhập email',
            'email.email' => 'Email không hợp lệ',
            'email.max' => 'Email không được vượt quá 100 ký tự',
            'matkhau.required' => 'Bạn chưa nhập mật khẩu',
            'matkhau.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
        ]);
        // check email and matkhau
        $user = KhachHang::where('email', $data['email'])->first();
        if ($user) {
            if (Hash::check($data['matkhau'], $user->matkhau)) {
                $user->token = $user->createToken('authToken')->accessToken;
                return response()->json($user, 200);
            } else {
                return response()->json(['errPassword' => 'Mật khẩu không đúng'], 401);
            }
        } else {
            return response()->json(['errEmail' => 'Email không tồn tại'], 404);
        }

        $user->token = $user->createToken('authToken')->accessToken;

        return response()->json($user, 201);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Successfully logged out'], 200);
    }

    public function majestic()
    {
        // món chính mới nhất
        $monan_moi = MonAn::where('danhmuc', '=', 1)->where('tinhtrang', '=', 1)->orderBy('created_at', 'desc')->take(8)->get();
        // món đặc sản
        $monan_db = MonAn::with(['danhmucmonss'])->where('danhmuc', '=', 4)->where('tinhtrang', '=', 1)->get();
        return response()->json([
            'monan_db' => $monan_db,
            'monan_moi' => $monan_moi
        ]);
    }

    public function menu()
    {
        $danhmucs = DanhMuc::get();
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
