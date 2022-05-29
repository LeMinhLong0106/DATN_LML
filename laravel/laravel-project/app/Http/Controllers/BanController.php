<?php

namespace App\Http\Controllers;

use App\Models\Ban;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class BanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
        // $this->middleware('isAdmin');
        $this->middleware('checkQuyen');
    }

    public function index()
    {
        $data = Ban::all();
        // $routeName = Route::currentRouteName();
        // $routeName = explode('.', $routeName);
        // $routeName = $routeName[0];

        // $route = DB::table('quyen')->where('tenquyen', $routeName)->get();
        // return $route;

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
            'ghe' => 'required',
        ], [
            'ghe.required' => 'Nhập số ghế',
        ]);
        $data = Ban::create($request->all());
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ban  $ban
     * @return \Illuminate\Http\Response
     */
    public function show(Ban $ban)
    {
        return response()->json($ban, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ban  $ban
     * @return \Illuminate\Http\Response
     */
    public function edit(Ban $ban)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ban  $ban
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $ban)
    {
        $this->validate($request, [
            'ghe' => 'required',
        ], [
            'ghe.required' => 'Nhập số ghế',
        ]);
        $data = Ban::find($ban);
        return response()->json($data->update($request->all()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ban  $ban
     * @return \Illuminate\Http\Response
     */
    public function destroy($ban)
    {
        $data = Ban::find($ban);
        $data->delete();
        return response()->json($data);
    }

    public function getBanTrong()
    {
        $data = Ban::where('tinhtrang', 0)->get();
        return response()->json($data);
    }
}
