<?php

namespace App\Http\Controllers;

use App\Models\DanhMuc;
use App\Models\Monan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MonanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd($danhsachmon);
        $data = Monan::with(['danhmucmonss'])->get();
        $monan = Monan::with(['danhmucmonss'])->where('tinhtrang', 1)->get();
        // dd($data);
        // return Monan::latest()->paginate(10);
        return response()->json([
            'datamonan' => $data,
            'monan' => $monan
        ], 200);

        
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
            'tenmonan' => 'required|unique:monan,tenmonan',
            'gia' => 'required|max:255',
            'donvitinh' => 'required|max:255',
            'danhmuc' => 'required|max:255',
            'hinhanh' => 'required|max:255',
        ], [
            'tenmonan.required' => 'Tên món ăn không được để trống',
            'tenmonan.unique' => 'Tên món ăn đã tồn tại',
            'gia.required' => 'Giá không được để trống',
            'donvitinh.required' => 'Đơn vị tính không được để trống',
            'danhmuc.required' => 'Danh mục không được để trống',
            'hinhanh.required' => 'Hình ảnh không được để trống',
        ]);

        $data = new Monan;
        $data->tenmonan = $request->tenmonan;
        $data->gia = $request->gia;
        $data->mota = $request->mota;
        $data->donvitinh = $request->donvitinh;
        $data->tinhtrang = $request->tinhtrang;
        $data->danhmuc = $request->danhmuc;

        if ($request->hasFile('hinhanh')) {
            $file = $request->file('hinhanh');
            $image = $file->getClientOriginalName();
            $file->move('images', $image);
            $data->hinhanh = $image;
        }
        $data->save();

        return response()->json([
            'status' => 200,
            'message' => 'Thêm món ăn thành công',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Monan  $monan
     * @return \Illuminate\Http\Response
     */
    public function show(Monan $monan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Monan  $monan
     * @return \Illuminate\Http\Response
     */
    public function edit(Monan $monan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Monan  $monan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $monan)
    {
        $this->validate($request, [
            'tenmonan' => 'required',
            'gia' => 'required|max:255',
            'donvitinh' => 'required|max:255',
            'danhmuc' => 'required|max:255',
            'hinhanh' => 'required|max:255',
        ], [
            'tenmonan.required' => 'Tên món ăn không được để trống',
            'tenmonan.unique' => 'Tên món ăn đã tồn tại',
            'gia.required' => 'Giá không được để trống',
            'donvitinh.required' => 'Đơn vị tính không được để trống',
            'danhmuc.required' => 'Danh mục không được để trống',
            'hinhanh.required' => 'Hình ảnh không được để trống',
        ]);

        $data = Monan::find($monan);
        $data->tenmonan = $request->tenmonan;
        $data->gia = $request->gia;
        $data->mota = $request->mota;
        $data->donvitinh = $request->donvitinh;
        $data->tinhtrang = $request->tinhtrang;
        $data->danhmuc = $request->danhmuc;

        if ($request->hasFile('hinhanh')) {
            $file = $request->file('hinhanh');
            $image = $file->getClientOriginalName();
            $file->move('images', $image);
            $data->hinhanh = $image;
        }
        $data->save();

        return response()->json([
            'status' => 200,
            'message' => 'Cập nhật món ăn thành công',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Monan  $monan
     * @return \Illuminate\Http\Response
     */
    public function destroy($monan)
    {
        $data = Monan::find($monan);
        $data->delete();
        return response()->json($data);
    }
}
