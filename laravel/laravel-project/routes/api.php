<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/majestic', 'GiaoDienController@majestic')->name('majestic');
Route::get('/menu', 'GiaoDienController@menu')->name('menu');
Route::get('/detail/{id}', 'GiaoDienController@detail')->name('detail');

// nhân viên
Route::post('/register', 'UserController@register');
Route::post('/login', 'UserController@login');

// đăng nhập với gg
Route::get('login/google', 'SocialController@redirectToProvider');
Route::get('login/google/callback', 'SocialController@handleProviderCallback');

// khách hàng
Route::post('/khachhang/register', 'KhachHangController@register')->name('khachhang.register');
Route::post('/khachhang/login', 'KhachHangController@login')->name('khachhang.login');
Route::post('checkout', 'GiaoDienController@checkout')->name('checkout');

// báo cáo
Route::get('baocao', 'BaoCaoController@index')->name('baocao.index');

// danh sách
Route::get('/indexBan', 'VaiTroQuyenController@indexBan')->name('indexBan');
Route::get('/indexMonan', 'VaiTroQuyenController@indexMonan')->name('indexMonan');

// Route::middleware('auth:api')->group(function () {
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
Route::get('hdtaiquay', 'HoaDonController@indexHDTQ')->name('hdtaiquay.indexHDTQ');
Route::get('hdonline', 'HoaDonController@indexHDO')->name('hdonline.indexHDO');
Route::get('hdtaiquay/{id}', 'HoaDonController@showHDTQ')->name('hdtaiquay.showHDTQ');
Route::get('hdonline/{id}', 'HoaDonController@showHDO')->name('hdonline.showHDO');
Route::delete('hdtaiquay/deleteHD/{id}', 'HoaDonController@deleteHD')->name('hdtaiquay.deleteHD');
Route::delete('hdonline/deleteHDO/{id}', 'HoaDonController@deleteHDO')->name('hdonline.deleteHDO');
Route::delete('hdtaiquay/deleteCTHD/{id}', 'HoaDonController@deleteCTHD')->name('hdtaiquay.deleteCTHD');

Route::put('hdtaiquay/{id}/thanhtoan', 'HoaDonController@thanhtoanhdtq');
Route::get('hdonline/{id}/thanhtoanon', 'HoaDonController@thanhtoanon');
Route::get('hdtaiquay/showReceipt/{id}', 'HoaDonController@showReceipt')->name('hdtaiquay.showReceipt');

Route::post('hdtaiquay/khdattruoc', 'HoaDonController@khdattruoc')->name('hdtaiquay.khdattruoc');
Route::get('/getBanTrong', 'BanController@getBanTrong')->name('getBanTrong');
Route::get('/getHDKD', 'HoaDonController@getHDKD')->name('getHDKD');

// thực đơn
Route::resource('order', 'OrderController');
Route::get('giaodienDB', 'OrderController@giaodienDB')->name('giaodienDB');
Route::get('order/table_status', 'OrderController@table_status')->name('order.table_status');
Route::get('order/getSaleDetails/{id}', 'OrderController@getSaleDetails')->name('order.getSaleDetails');
Route::post('order/orderFood', 'OrderController@orderFood')->name('order.orderFood');
Route::post('order/deleteOrder', 'OrderController@deleteOrder')->name('order.deleteOrder');
Route::post('order/updateSoluong', 'OrderController@updateSoluong')->name('order.updateSoluong');
Route::post('order/changeQuantityIn', 'OrderController@changeQuantityIn')->name('order.changeQuantityIn');
Route::post('order/changeQuantityDe', 'OrderController@changeQuantityDe')->name('order.changeQuantityDe');
Route::post('order/confirmOrder', 'OrderController@confirmOrder')->name('order.confirmOrder');

Route::get('/user', 'UserController@getUser');
Route::get('/getKH', 'KhachHangController@getKH');
Route::post('/logout', 'UserController@logout');

Route::post('/khachhang/logout', 'KhachHangController@logout')->name('khachhang.logout');
// });



