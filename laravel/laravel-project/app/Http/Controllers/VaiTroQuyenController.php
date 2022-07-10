<?php

namespace App\Http\Controllers;

use App\Models\Ban;
use App\Models\KhachHang;
use App\Models\MonAn;
use App\Models\VaiTroQuyen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class VaiTroQuyenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexBan()
    {
        $data = Ban::all();
        return response()->json($data, 200);
    }

    public function indexMonan()
    {
        $data = MonAn::where('tinhtrang', 1)->get();
        return response()->json($data, 200);
    }

    public function forgot(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
        ], [
            'email.required' => 'Nhập email',
        ]);

        $email = $request->input('email');
        if (User::where('email', $email)->doesntExist()) {
            return response()->json(['error' => 'Email không tồn tại'], 404);
        }

        $token = Str::random(10);

        try {
            DB::table('password_resets')->insert([
                'email' => $email,
                'token' => $token,
            ]);

            $data = [
                'email' => $email,
                'token' => $token,
            ];

            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function reset(Request $request)
    {
        $this->validate($request, [
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ], [
            'password.required' => 'Nhập mật khẩu',
            'password_confirmation.required' => 'Nhập lại mật khẩu',
            'password_confirmation.same' => 'Mật khẩu không trùng khớp',
        ]);
        $token = $request->input('token');
        if (!$passwordResets = DB::table('password_resets')->where('token', $token)->first()) {
            return response()->json(['error' => 'Token không tồn tại'], 404);
        }

        if (!$user = User::where('email', $passwordResets->email)->first()) {
            return response()->json(['error' => 'Email không tồn tại'], 404);
        }

        $user->password = Hash::make($request->input('password'));
        $user->save();

        return response()->json(['message' => 'Đổi mật khẩu thành công'], 200);
    }

    public function forgotKH(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
        ], [
            'email.required' => 'Nhập email',
        ]);

        $email = $request->input('email');
        if (KhachHang::where('email', $email)->doesntExist()) {
            return response()->json(['error' => 'Email không tồn tại'], 404);
        }

        $token = Str::random(10);

        try {
            DB::table('password_resets')->insert([
                'email' => $email,
                'token' => $token,
            ]);

            $data = [
                'email' => $email,
                'token' => $token,
            ];

            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function resetKH(Request $request)
    {
        $this->validate($request, [
            'matkhau' => 'required',
            'password_confirmation' => 'required|same:matkhau',
        ], [
            'matkhau.required' => 'Nhập mật khẩu',
            'password_confirmation.required' => 'Nhập lại mật khẩu',
            'password_confirmation.same' => 'Mật khẩu không trùng khớp',
        ]);
        $token = $request->input('token');
        if (!$passwordResets = DB::table('password_resets')->where('token', $token)->first()) {
            return response()->json(['error' => 'Token không tồn tại'], 404);
        }

        if (!$user = KhachHang::where('email', $passwordResets->email)->first()) {
            return response()->json(['error' => 'Email không tồn tại'], 404);
        }

        $user->matkhau = Hash::make($request->input('matkhau'));
        $user->save();

        return response()->json(['message' => 'Đổi mật khẩu thành công'], 200);
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VaiTroQuyen  $vaiTroQuyen
     * @return \Illuminate\Http\Response
     */
    public function show(VaiTroQuyen $vaiTroQuyen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VaiTroQuyen  $vaiTroQuyen
     * @return \Illuminate\Http\Response
     */
    public function edit(VaiTroQuyen $vaiTroQuyen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VaiTroQuyen  $vaiTroQuyen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VaiTroQuyen $vaiTroQuyen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VaiTroQuyen  $vaiTroQuyen
     * @return \Illuminate\Http\Response
     */
    public function destroy(VaiTroQuyen $vaiTroQuyen)
    {
        //
    }
}
