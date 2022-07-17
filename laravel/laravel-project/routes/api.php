<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/majestic', 'GiaoDienController@majestic')->name('majestic');
Route::get('/menu', 'GiaoDienController@menu')->name('menu');
Route::get('/detail/{id}', 'GiaoDienController@detail')->name('detail');

// nhân viên
Route::get('/getuser', 'UserController@getUser');
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
Route::get('/getCus/{id}', 'KhachHangController@getCus');
Route::get('/getOrder/{id}', 'KhachHangController@getOrder');

Route::post('/forgotKH', 'VaiTroQuyenController@forgotKH');
Route::post('/resetKH', 'VaiTroQuyenController@resetKH');

// reset pass with mail
Route::post('/sendToken', 'VaiTroQuyenController@sendToken');
Route::post('/validateToken', 'VaiTroQuyenController@validateToken');
Route::post('/resetPass', 'VaiTroQuyenController@resetPass');

// danh sách
Route::get('/indexBan', 'VaiTroQuyenController@indexBan')->name('indexBan');
Route::get('/indexMonan', 'VaiTroQuyenController@indexMonan')->name('indexMonan');

// quản trị viên
Route::resource('/table', 'BanController');
Route::resource('/category', 'DanhMucController');
Route::resource('/food', 'MonanController');
Route::resource('/customer', 'KhachHangController');
Route::resource('/role', 'VaiTroController');
Route::resource('/permission', 'QuyenController');
Route::resource('/user', 'UserController');
Route::post('/update_nv/{id}', 'UserController@update_nv');
Route::post('/update_ma/{id}', 'MonanController@update_ma');

// hóa đơn
Route::group(['prefix' => 'hdtaiquay'], function () {
    Route::get('/', 'HoaDonController@indexHDTQ')->name('hdtaiquay.indexHDTQ');
    Route::get('/{id}', 'HoaDonController@showHDTQ')->name('hdtaiquay.showHDTQ');
    Route::delete('/deleteHD/{id}', 'HoaDonController@deleteHD')->name('hdtaiquay.deleteHD');
    Route::put('/{id}/thanhtoan', 'HoaDonController@thanhtoanhdtq')->name('hdtaiquay.thanhtoanhdtq');
    Route::post('/khdattruoc', 'HoaDonController@khdattruoc')->name('hdtaiquay.khdattruoc');
    Route::post('/updateSoluong', 'HoaDonController@updateSoluong')->name('hdtaiquay.updateSoluong');
});

Route::group(['prefix' => 'hdonline'], function () {
    Route::get('/', 'HoaDonController@indexHDO')->name('hdonline.indexHDO');
    Route::get('/{id}', 'HoaDonController@showHDO')->name('hdonline.showHDO');
    Route::delete('/deleteHDO/{id}', 'HoaDonController@deleteHDO')->name('hdonline.deleteHDO');
    Route::get('/{id}/thanhtoanon', 'HoaDonController@thanhtoanon');
});

// Route::get('/getEmptyTable', 'BanController@getBanTrong')->name('getEmptyTable');

// thực đơn
Route::group(['prefix' => 'order'], function () {
    Route::get('/', 'OrderController@order')->name('order');
    Route::get('getHDKD', 'OrderController@getHDKD')->name('order.getHDKD');
    Route::get('getSaleDetails/{id}', 'OrderController@getSaleDetails')->name('order.getSaleDetails');
    Route::post('orderFood', 'OrderController@orderFood')->name('order.orderFood');
    Route::post('deleteOrder', 'OrderController@deleteOrder')->name('order.deleteOrder');
    Route::post('updateQuantity', 'OrderController@updateQuantity')->name('order.updateQuantity');
    Route::post('updateNote', 'OrderController@updateNote')->name('order.updateNote');
    Route::post('confirmOrder', 'OrderController@confirmOrder')->name('order.confirmOrder');
});
// đầu bếp
Route::get('listCook', 'DauBepController@listCook')->name('listCook');

// báo cáo
Route::get('report', 'BaoCaoController@index')->name('report.index');
Route::post('baocao', 'BaoCaoController@baocao')->name('report.baocao');
