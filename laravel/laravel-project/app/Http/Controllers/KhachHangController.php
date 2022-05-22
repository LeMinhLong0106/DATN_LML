<?php

namespace App\Http\Controllers;

use App\Models\KhachHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KhachHangController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'tenkh' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:khachhang',
            'sdt' => 'required|string|max:255',
            'diachi' => 'required|string|max:255',
            'matkhau' => 'required|string|min:6',
        ]);
        $user = KhachHang::create([
            'tenkh' => $data['tenkh'],
            'email' => $data['email'],
            'sdt' => $data['sdt'],
            'diachi' => $data['diachi'],
            'matkhau' => Hash::make($data['matkhau']),
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
            'matkhau' => 'required|string|min:6',
        ]);
        // check email and matkhau
        $user = KhachHang::where('email', $data['email'])->first();
        if ($user) {
            if (Hash::check($data['matkhau'], $user->matkhau)) {
                $user->token = $user->createToken('authToken')->accessToken;
                return response()->json($user, 200);
            } else {
                return response()->json(['error' => 'Password is incorrect'], 401);
            }
        } else {
            return response()->json(['error' => 'User is not found'], 404);
        }

        $user->token = $user->createToken('authToken')->accessToken;

        return response()->json($user, 201);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Successfully logged out'], 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function getKH(Request $request)
    // {
    //     return response()->json($request->user('api'), 200);
    // }

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
     * @param  \App\Models\KhachHang  $khachHang
     * @return \Illuminate\Http\Response
     */
    public function show(KhachHang $khachHang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KhachHang  $khachHang
     * @return \Illuminate\Http\Response
     */
    public function edit(KhachHang $khachHang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KhachHang  $khachHang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KhachHang $khachHang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KhachHang  $khachHang
     * @return \Illuminate\Http\Response
     */
    public function destroy(KhachHang $khachHang)
    {
        //
    }
}
