<?php

namespace App\Http\Controllers;

use App\Models\DanhMuc;
use App\Models\Monan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class MonanController extends Controller
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

    // public function index()
    // {
    //     $pageLength = request('pageLength') ?? 10;
    //     $users = Monan::with('danhmuc')->paginate($pageLength);

    //     return response()->json($users, 200);
    // }

    public function index()
    {
        // $monans = Monan::with(['danhmucmonss'])->paginate(10);
        // return response()->json($monans, 200);
        $data = Monan::with(['danhmucmonss'])->get();
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
        $this->validate($request, [
            'tenmonan' => 'required|unique:monan,tenmonan',
            'gia' => 'required|max:255',
            'donvitinh' => 'required|max:255',
            'mota' => 'required|max:255',
            'danhmuc' => 'required|max:255',
            'hinhanh' => 'required',
        ], [
            'tenmonan.required' => 'Tên món ăn không được để trống',
            'tenmonan.unique' => 'Tên món ăn đã tồn tại',
            'gia.required' => 'Giá không được để trống',
            'donvitinh.required' => 'Đơn vị tính không được để trống',
            'mota.required' => 'Mô tả không được để trống',
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
            'message' => 'Thêm món ăn thành công',
            'data' => $data
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Monan  $monan
     * @return \Illuminate\Http\Response
     */
    public function show($monan)
    {
        $data = Monan::with(['danhmucmonss'])->find($monan);
        return response()->json($data);
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

    public function update_ma(Request $request, $monan)
    {
        $this->validate($request, [
            'tenmonan' => 'required|unique:monan,tenmonan,' . $monan,
            'gia' => 'required|max:255',
            'donvitinh' => 'required|max:255',
            'danhmuc' => 'required|max:255',
            'hinhanh' => 'required',
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
            'message' => 'Cập nhật món ăn thành công',
        ]);
    }

    public function update(Request $request, $monan)
    {
        $this->validate($request, [
            'tenmonan' => 'required|unique:monan,tenmonan,' . $monan,
            'gia' => 'required|max:255',
            'donvitinh' => 'required|max:255',
            'danhmuc' => 'required|max:255',
            'hinhanh' => 'required',
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
            'message' => 'Cập nhật món ăn thành công',
            'data' => $data
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
        return response()->json(
            [
                'message' => 'Xóa món ăn thành công',
            ]
        );
    }
}
