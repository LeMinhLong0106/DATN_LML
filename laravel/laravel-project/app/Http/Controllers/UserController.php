<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'hoten' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'sdt' => 'required|string|max:255',
            'diachi' => 'required|string|max:255',
        ]);
        $user = User::create([
            'hoten' => $data['hoten'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'sdt' => $data['sdt'],
            'diachi' => $data['diachi'],

        ]);

        return response()->json(
            [
                'message' => 'User created successfully',
                'user' => $user,
            ],
            201
        );
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ], [
            'email.required' => 'Nhập email',
            'email.email' => 'Email không hợp lệ',
            'password.required' => 'Nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
        ]);

        // check email and password
        $user = User::where('email', $data['email'])->first();
        if ($user) {
            if (Hash::check($data['password'], $user->password)) {
                $user->token = $user->createToken('authToken')->accessToken;
                return response()->json($user, 200);
            } else {
                return response()->json(['errors' => 'Mật khẩu không đúng'], 401);
            }
        } else {
            return response()->json(['errors' => 'Email không tồn tại'], 404);
        }

        $user->token = $user->createToken('authToken')->accessToken;

        return response()->json($user, 201);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Successfully logged out'], 200);
    }

    public function getUser(Request $request)
    {
        $user = User::with(['vaitross'])->find($request->user('api')->id);
        $user->userquyen = User::find($request->user('api')->id)->vaitross->quyens;
        // $user = DB::table('users')->find($request->user('api')->id);
        return response()->json($user, 200);
        // return response()->json($request->user('api'), 200);
    }

    public function index()
    {
        $data = User::with(['vaitross'])->get();
        return response()->json($data, 200);
    }

    public function show($id)
    {
        $data = User::with(['vaitross'])->find($id);
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'hoten' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
            'sdt' => 'required|min:10',
            'diachi' => 'required|string|max:255',
            'ngaysinh' => 'required|date',
            'hinhanh' => 'required',
        ], [
            'hoten.required' => 'Nhập họ tên',
            'email.required' => 'Nhập email',
            'password.required' => 'Nhập mật khẩu',
            'sdt.required' => 'Nhập số điện thoại',
            'sdt.min' => 'Số điện thoại phải có ít nhất 10 số',
            'diachi.required' => 'Nhập địa chỉ',
            'ngaysinh.required' => 'Nhập ngày sinh', 
            'hinhanh.required' => 'Hình ảnh không được để trống',           
        ]);

        $data = new User;
        $data->hoten = $request->hoten;
        $data->gioitinh = $request->gioitinh;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        $data->sdt = $request->sdt;
        $data->diachi = $request->diachi;
        $data->ngaysinh = $request->ngaysinh;
        $data->vaitro_id = $request->vaitro_id;

        if ($request->hasFile('hinhanh')) {
            $file = $request->file('hinhanh');
            $image = $file->getClientOriginalName();
            $file->move('images', $image);
            $data->hinhanh = $image;
        }
        $data->save();

        return response()->json([
            'message' => 'Thêm nhân viên thành công',
        ]);
    }

    public function update_nv(Request $request, $nhanvien)
    {
        $this->validate($request, [
            'hoten' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
            'sdt' => 'required|min:10',
            'diachi' => 'required|string|max:255',
            'ngaysinh' => 'required|date',
        ], [
            'hoten.required' => 'Nhập họ tên',
            'email.required' => 'Nhập email',
            'password.required' => 'Nhập mật khẩu',
            'sdt.required' => 'Nhập số điện thoại',
            'sdt.min' => 'Số điện thoại phải có ít nhất 10 số',
            'diachi.required' => 'Nhập địa chỉ',
            'ngaysinh.required' => 'Nhập ngày sinh',
        ]);

        $data = User::find($nhanvien);
        $data->hoten = $request->hoten;
        $data->gioitinh = $request->gioitinh;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        $data->sdt = $request->sdt;
        $data->ngaysinh = $request->ngaysinh;
        $data->diachi = $request->diachi;
        $data->vaitro_id = $request->vaitro_id;

        if ($request->hasFile('hinhanh')) {
            $file = $request->file('hinhanh');
            $image = $file->getClientOriginalName();
            $file->move('images', $image);
            $data->hinhanh = $image;
        }
        $data->save();

        return response()->json([
            'message' => 'Cập nhật nhân viên thành công',
        ]);
    }

    public function update(Request $request, $nhanvien)
    {
        $this->validate($request, [
            'hoten' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
            'sdt' => 'required|numeric',
            'diachi' => 'required|string|max:255',
            'vaitro_id' => 'required',
        ], [
            'hoten.required' => 'Nhập họ tên',
            'email.required' => 'Nhập email',
            'password.required' => 'Nhập mật khẩu',
            'sdt.required' => 'Nhập số điện thoại',
            'diachi.required' => 'Nhập địa chỉ',
            'vaitro_id.required' => 'Nhập vai trò',
        ]);

        $data = User::find($nhanvien);
        $data->hoten = $request->hoten;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        $data->sdt = $request->sdt;
        $data->diachi = $request->diachi;
        $data->vaitro_id = $request->vaitro_id;

        if ($request->hasFile('hinhanh')) {
            $file = $request->file('hinhanh');
            $image = $file->getClientOriginalName();
            $file->move('images', $image);
            $data->hinhanh = $image;
        }
        $data->save();

        return response()->json([
            'status' => 200,
            'message' => 'Cập nhật nhân viên thành công',
        ]);
    }

    public function destroy($nhanvien)
    {
        $data = User::find($nhanvien);
        $data->delete();
        return response()->json(
            [
                'message' => 'Xóa nhân viên thành công',
            ]
        );
    }
}
