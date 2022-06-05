<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/majestic', 'GiaoDienController@majestic')->name('majestic');
Route::get('/menu', 'GiaoDienController@menu')->name('menu');
Route::get('/detail/{id}', 'GiaoDienController@detail')->name('detail');

// nhân viên
Route::get('/user', 'UserController@getUser');
Route::post('/register', 'UserController@register');
Route::post('/login', 'UserController@login');
Route::post('/logout', 'UserController@logout');

// đăng nhập với gg
Route::get('login/google', 'SocialController@redirectToProvider');
Route::get('login/google/callback', 'SocialController@handleProviderCallback');

// khách hàng
Route::post('/khachhang/register', 'GiaoDienController@register')->name('khachhang.register');
Route::post('/khachhang/login', 'GiaoDienController@login')->name('khachhang.login');
Route::post('checkout', 'GiaoDienController@checkout')->name('checkout');
Route::get('/getKH', 'KhachHangController@getKH');
Route::post('/khachhang/logout', 'KhachHangController@logout')->name('khachhang.logout');

// báo cáo
Route::get('baocao', 'BaoCaoController@index')->name('baocao.index');

// danh sách
Route::get('/indexBan', 'VaiTroQuyenController@indexBan')->name('indexBan');
Route::get('/indexMonan', 'VaiTroQuyenController@indexMonan')->name('indexMonan');

// quản trị viên
Route::resource('/ban', 'BanController');
Route::resource('/danhmuc', 'DanhMucController');
Route::resource('/monan', 'MonanController');
Route::resource('/khachhang', 'KhachHangController');
Route::resource('/vaitro', 'VaiTroController');
Route::resource('/quyen', 'QuyenController');
Route::resource('/nhanvien', 'UserController');
Route::post('/update_nv/{id}', 'UserController@update_nv');
Route::post('/update_ma/{id}', 'MonanController@update_ma');

// hóa đơn
Route::group(['prefix' => 'hdtaiquay'], function () {
    Route::get('/', 'HoaDonController@indexHDTQ')->name('hdtaiquay.indexHDTQ');
    Route::get('/{id}', 'HoaDonController@showHDTQ')->name('hdtaiquay.showHDTQ');
    Route::delete('/deleteHD/{id}', 'HoaDonController@deleteHD')->name('hdtaiquay.deleteHD');

    // Route::delete('/deleteCTHD/{id}', 'HoaDonController@deleteCTHD')->name('hdtaiquay.deleteCTHD');
    Route::put('/{id}/thanhtoan', 'HoaDonController@thanhtoanhdtq');
    // Route::get('/{id}/showReceipt', 'HoaDonController@showReceipt')->name('hdtaiquay.showReceipt');
    Route::post('/khdattruoc', 'HoaDonController@khdattruoc')->name('hdtaiquay.khdattruoc');
});

Route::group(['prefix' => 'hdonline'], function () {
    Route::get('/', 'HoaDonController@indexHDO')->name('hdonline.indexHDO');
    Route::get('/{id}', 'HoaDonController@showHDO')->name('hdonline.showHDO');
    Route::delete('/deleteHDO/{id}', 'HoaDonController@deleteHDO')->name('hdonline.deleteHDO');

    Route::get('/{id}/thanhtoanon', 'HoaDonController@thanhtoanon');
});

Route::get('/getBanTrong', 'BanController@getBanTrong')->name('getBanTrong');
Route::get('/getHDKD', 'HoaDonController@getHDKD')->name('getHDKD');

// thực đơn
Route::group(['prefix' => 'order'], function () {
    Route::get('/', 'OrderController@order')->name('order');
    // Route::get('table_status', 'OrderController@table_status')->name('order.table_status');
    Route::get('getSaleDetails/{id}', 'OrderController@getSaleDetails')->name('order.getSaleDetails');
    Route::post('orderFood', 'OrderController@orderFood')->name('order.orderFood');
    Route::post('deleteOrder', 'OrderController@deleteOrder')->name('order.deleteOrder');
    Route::post('updateSoluong', 'OrderController@updateSoluong')->name('order.updateSoluong');
    Route::post('confirmOrder', 'OrderController@confirmOrder')->name('order.confirmOrder');
});

Route::get('daubep', 'DauBepController@daubep')->name('daubep');


