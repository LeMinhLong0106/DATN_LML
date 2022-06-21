<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/majestic', 'GiaoDienController@majestic')->name('majestic');
Route::get('/menu', 'GiaoDienController@menu')->name('menu');
Route::get('/detail/{id}', 'GiaoDienController@detail')->name('detail');

// nhân viên
Route::get('/user', 'UserController@getUser');
Route::post('/register', 'UserController@register');
Route::post('/login', 'UserController@login');
// Route::post('/logout', 'UserController@logout');
Route::post('/forgot', 'VaiTroQuyenController@forgot');
Route::post('/reset', 'VaiTroQuyenController@reset');

// đăng nhập với gg
Route::get('login/google', 'SocialController@redirectToProvider');
Route::get('login/google/callback', 'SocialController@handleProviderCallback');

// khách hàng
Route::post('/customer/register', 'GiaoDienController@register')->name('customer.register');
Route::post('/customer/login', 'GiaoDienController@login')->name('customer.login');
Route::post('checkout', 'GiaoDienController@checkout')->name('checkout');
Route::get('/getCus', 'KhachHangController@getKH');
Route::get('/getOrder', 'KhachHangController@getOrder');
// Route::post('/customer/logout', 'KhachHangController@logout')->name('customer.logout');

// danh sách
Route::get('/indexBan', 'VaiTroQuyenController@indexBan')->name('indexBan');
Route::get('/indexMonan', 'VaiTroQuyenController@indexMonan')->name('indexMonan');

// quản trị viên
Route::resource('/ban', 'BanController');
Route::resource('/danhmuc', 'DanhMucController');
Route::resource('/monan', 'MonanController');
Route::resource('/customer', 'KhachHangController');
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
    Route::put('/{id}/thanhtoan', 'HoaDonController@thanhtoanhdtq');
    Route::post('/khdattruoc', 'HoaDonController@khdattruoc')->name('hdtaiquay.khdattruoc');
    Route::post('/updateSoluong', 'HoaDonController@updateSoluong')->name('hdtaiquay.updateSoluong');
});

Route::group(['prefix' => 'hdonline'], function () {
    Route::get('/', 'HoaDonController@indexHDO')->name('hdonline.indexHDO');
    Route::get('/{id}', 'HoaDonController@showHDO')->name('hdonline.showHDO');
    Route::delete('/deleteHDO/{id}', 'HoaDonController@deleteHDO')->name('hdonline.deleteHDO');
    Route::get('/{id}/thanhtoanon', 'HoaDonController@thanhtoanon');
});

Route::get('/getEmptyTable', 'BanController@getBanTrong')->name('getEmptyTable');
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


// báo cáo
Route::get('baocao', 'BaoCaoController@index')->name('baocao.index');
