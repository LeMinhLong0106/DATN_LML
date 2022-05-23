<?php

namespace App\Http\Controllers;

use App\Models\Quyen;
use Illuminate\Http\Request;

class QuyenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quyen = Quyen::all();
        return response()->json($quyen);
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
        $request->validate([
            'tenquyen' => 'required|unique:quyen,tenquyen',
            'mota' => 'required',
        ], [
            'tenquyen.required' => 'Tên quyền không được để trống',
            'tenquyen.unique' => 'Tên quyền đã tồn tại',
            'mota.required' => 'Mô tả không được để trống',
        ]);
        $quyen = Quyen::create($request->all());
        return response()->json($quyen);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Quyen  $quyen
     * @return \Illuminate\Http\Response
     */
    public function show(Quyen $quyen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Quyen  $quyen
     * @return \Illuminate\Http\Response
     */
    public function edit(Quyen $quyen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Quyen  $quyen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $quyen)
    {
        $request->validate([
            'tenquyen' => 'required',
            'mota' => 'required',
        ], [
            'tenquyen.required' => 'Tên quyền không được để trống',
            'mota.required' => 'Mô tả không được để trống',
        ]);
        $quyen = Quyen::find($quyen)->update($request->all());
        return response()->json($quyen);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Quyen  $quyen
     * @return \Illuminate\Http\Response
     */
    public function destroy($quyen)
    {
        $quyen = Quyen::find($quyen)->delete();
        return response()->json($quyen);
    }
}
