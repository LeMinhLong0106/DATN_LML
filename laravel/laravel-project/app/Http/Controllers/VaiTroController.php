<?php

namespace App\Http\Controllers;

use App\Models\VaiTro;
use Illuminate\Http\Request;

class VaiTroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('checkQuyen');
    }

    public function index()
    {
        $data = VaiTro::with(['quyens'])->get();
        return response()->json($data);
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
        $this->validate($request, [
            'tenvaitro' => 'required',
            'mota' => 'required',
        ], [
            'tenvaitro.required' => 'Nhập tên vai trò',
            'mota.required' => 'Nhập mô tả vai trò',
        ]);
        $data = VaiTro::create($request->all());
        return response()->json(
            [
                'message' => 'Thêm vai trò thành công',
                'data' => $data,
            ],
            201
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VaiTro  $vaiTro
     * @return \Illuminate\Http\Response
     */
    public function show($vaiTro)
    {
        $data = VaiTro::find($vaiTro);
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VaiTro  $vaiTro
     * @return \Illuminate\Http\Response
     */
    public function edit(VaiTro $vaiTro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VaiTro  $vaiTro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $vaiTro)
    {
        $this->validate($request, [
            'tenvaitro' => 'required',
            'mota' => 'required',
        ], [
            'tenvaitro.required' => 'Nhập tên vai trò',
            'mota.required' => 'Nhập mô tả vai trò',
        ]);
        $data = VaiTro::find($vaiTro);
        $data->update($request->all());
        return response()->json(
            [
                'message' => 'Cập nhật vai trò thành công',
                'data' => $data,
            ],
            201
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VaiTro  $vaiTro
     * @return \Illuminate\Http\Response
     */
    public function destroy($vaiTro)
    {
        $a = VaiTro::with(['users'])->find($vaiTro);
        if (count($a->users) > 0) {
            return response()->json(['error' => 'Tồn tại nhân viên trong vai trò'], 500);
        } else {
            $data = VaiTro::find($vaiTro);
            $data->delete();
            return response()->json(
                [
                    'message' => 'Xóa thành công vai trò',
                ],
            );
        }
    }
}
