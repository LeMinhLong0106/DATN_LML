<?php

namespace App\Http\Controllers;

use App\Models\Ban;
use App\Models\MonAn;
use App\Models\VaiTroQuyen;
use Illuminate\Http\Request;

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
        $data = MonAn::all();
        return response()->json($data, 200);
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
