<?php

namespace App\Http\Controllers;

use App\Models\DanhMuc;
use Illuminate\Http\Request;

class DanhMucController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        // $data = DanhMuc::all();
        // return response()->json($data, 200);
        return DanhMuc::latest()->paginate(20);
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
            'tendm' => 'required|unique:danhmucmon,tendm',
            'uutien' => 'required|max:255',
        ],[
            'tendm.required' => 'Tên danh mục không được để trống',
            'tendm.unique' => 'Tên danh mục đã tồn tại',
            'uutien.required' => 'Ưu tiên không được để trống',
        ]);
        $data = DanhMuc::create($request->all());
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DanhMuc  $danhMuc
     * @return \Illuminate\Http\Response
     */
    public function show(DanhMuc $danhMuc)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DanhMuc  $danhMuc
     * @return \Illuminate\Http\Response
     */
    public function edit(DanhMuc $danhMuc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DanhMuc  $danhMuc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $danhMuc)
    {
        $this->validate($request, [
            'tendm' => 'required',
            'uutien' => 'required|max:255',
        ],[
            'tendm.required' => 'Tên danh mục không được để trống',
            'uutien.required' => 'Ưu tiên không được để trống',
        ]);
        $data = DanhMuc::find($danhMuc);
        return response()->json($data->update($request->all()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DanhMuc  $danhMuc
     * @return \Illuminate\Http\Response
     */
    public function destroy($danhMuc)
    {
        // return response()->json($danhMuc->delete());
        $data = DanhMuc::find($danhMuc);
        $data->delete();
        return response()->json($data);
    }
}
