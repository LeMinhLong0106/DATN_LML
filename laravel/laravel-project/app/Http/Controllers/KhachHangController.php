<?php

namespace App\Http\Controllers;

use App\Models\CTHD;
use App\Models\HoaDon;
use App\Models\KhachHang;
use Illuminate\Http\Request;

class KhachHangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('checkQuyen');
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
        $data = KhachHang::all();
        return response()->json($data, 200);
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
    public function show($khachHang)
    {
        $data = KhachHang::find($khachHang);
        return response()->json($data, 200);
    }

    public function getKH(Request $request)
    {
        $user = KhachHang::find($request->user('api')->id);
        return response()->json($user, 200);
    }

    public function getOrder(Request $request)
    {
        $user = KhachHang::find($request->user('api')->id);
        $order = HoaDon::with(['cthds','monanss'])->where('khachhang_id', $user->id)->get();
        
        return response()->json($order,
            200
        );
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
    public function destroy($khachHang)
    {
        $data = KhachHang::find($khachHang);
        $data->delete();
        return response()->json($data);
    }
}
