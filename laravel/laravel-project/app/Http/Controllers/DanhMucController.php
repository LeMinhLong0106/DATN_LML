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

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('checkQuyen');
    }

    public function index()
    {
        $data = DanhMuc::all();
        return response()->json($data, 200);
        // return DanhMuc::latest()->paginate(20);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'tendm' => 'required|unique:danhmucmon,tendm',
            'uutien' => 'required|numeric|min:1|max:10',
        ], [
            'tendm.required' => 'Tên danh mục không được để trống',
            'tendm.unique' => 'Tên danh mục đã tồn tại',
            'uutien.required' => 'Ưu tiên không được để trống',
            'uutien.min' => 'Ưu tiên phải lớn hơn 1',
            'uutien.max' => 'Ưu tiên phải nhỏ hơn 10',
        ]);
        $data = DanhMuc::create($request->all());
        return response()->json(
            [
                'message' => 'Thêm danh mục thành công',
                'data' => $data,
            ],
            201
        );
    }

    public function update(Request $request, $danhMuc)
    {
        $this->validate($request, [
            'tendm' => 'required',
            'uutien' => 'required|numeric|min:1|max:10',
        ], [
            'tendm.required' => 'Tên danh mục không được để trống',
            'uutien.required' => 'Ưu tiên không được để trống',
            'uutien.min' => 'Ưu tiên phải lớn hơn 1',
            'uutien.max' => 'Ưu tiên phải nhỏ hơn 10',
        ]);
        $data = DanhMuc::find($danhMuc);
        $data->update($request->all());
        return response()->json(
            [
                'message' => 'Cập nhật danh mục thành công',
                'data' => $data,
            ],
            200
        );
    }

    public function destroy($danhMuc)
    {
        $a = DanhMuc::with(['monan'])->find($danhMuc);
        if (count($a->monan) > 0) {
            return response()->json(['error' => 'Đang tồn tại món ăn trong danh mục'], 500);
        } else {
            $data = DanhMuc::find($danhMuc);
            $data->delete();
            return response()->json([
                'message' => 'Xóa danh mục thành công',
            ],);
        }
    }
}
