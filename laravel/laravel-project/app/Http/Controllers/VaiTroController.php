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
        return $request->all();
        $request->validate([
            'tenvaitro' => 'required|unique:vaitro,tenvaitro',
            'mota' => 'required',
        ], [
            'tenvaitro.required' => 'Tên vai trò không được để trống',
            'tenvaitro.unique' => 'Tên vai trò đã tồn tại',
            'mota.required' => 'Mô tả không được để trống',
        ]);
        $vaitro = VaiTro::create(
            [
                'tenvaitro' => $request->tenvaitro,
                'mota' => $request->mota,
            ]
        );
        // $vaitro->quyens()->attach($request->quyen);
        return $vaitro;
        // return response()->json($vaitro);
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
        $request->validate([
            'tenvaitro' => 'required',
            'mota' => 'required',
        ], [
            'tenvaitro.required' => 'Tên vai trò không được để trống',
            'mota.required' => 'Mô tả không được để trống',
        ]);
        $vaitro = VaiTro::find($vaiTro);
        $vaitro->update($request->all());
        return response()->json($vaitro);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VaiTro  $vaiTro
     * @return \Illuminate\Http\Response
     */
    public function destroy($vaiTro)
    {
        $vaitro = VaiTro::find($vaiTro)->delete();
        return response()->json($vaitro);
    }
}
