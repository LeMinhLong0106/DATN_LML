<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/majestic', 'GiaoDienController@majestic')->name('majestic');
Route::get('/menu', 'GiaoDienController@menu')->name('menu');
Route::get('/detail/{id}', 'GiaoDienController@detail')->name('detail');


// Route::get('/about', 'GiaoDienController@about')->name('about');
// Route::get('/search', 'GiaoDienController@search')->name('search');
// Route::get('/addToCart/{id}', 'GiaoDienController@addToCart')->name('addToCart');
// Route::get('/showCart', 'GiaoDienController@showCart')->name('showCart');

// nhân viên
Route::post('/register', 'UserController@register');
Route::post('/login', 'UserController@login');
// khách hàng
Route::post('/khachhang/register', 'KhachHangController@register')->name('khachhang.register');
Route::post('/khachhang/login', 'KhachHangController@login')->name('khachhang.login');



Route::middleware('auth:api')->group(function () {
    // Route::group(['middleware' => 'isAdmin'], function () {
    //     Route::resource('/ban', 'BanController');
    //     Route::resource('/danhmuc', 'DanhMucController');
    //     Route::resource('/monan', 'MonanController');
    // });

    // Route::group(['middleware' => 'isTN'], function () {
    //     // hóa đơn
    //     Route::get('hdtaiquay', 'HoaDonController@indexHDTQ')->name('hdtaiquay.indexHDTQ');
    //     // Route::get('hdonline', 'HoaDonController@indexHDO')->name('hdonline.indexHDO');
    //     Route::get('hdtaiquay/{id}', 'HoaDonController@showHDTQ')->name('hdtaiquay.showHDTQ');
    //     // Route::get('hdonline/{id}', 'HoaDonController@showHDO')->name('hdonline.showHDO');
    //     Route::delete('hdtaiquay/deleteHD/{id}', 'HoaDonController@deleteHD')->name('hdtaiquay.deleteHD');
    //     // Route::delete('hdonline/deleteHDO/{id}', 'HoaDonController@deleteHDO')->name('hdonline.deleteHDO');
    //     Route::delete('hdtaiquay/deleteCTHD/{id}', 'HoaDonController@deleteCTHD')->name('hdtaiquay.deleteCTHD');
    //     // Route::post('hdtaiquay/thanhtoanhdtq/{id}', 'HoaDonController@thanhtoanhdtq')->name('hdtaiquay.thanhtoanhdtq');
    //     Route::put('hdtaiquay/{id}/thanhtoan', 'HoaDonController@thanhtoanhdtq');
    //     // Route::post('hdonline/thanhtoanon/{id}', 'HoaDonController@thanhtoanon')->name('hdonline.thanhtoanon');
    //     Route::get('hdtaiquay/showReceipt/{id}', 'HoaDonController@showReceipt')->name('hdtaiquay.showReceipt');

    //     // báo cáo
    //     Route::get('baocao', 'BaoCaoController@index')->name('baocao.index');
    // });

    // Route::group(['middleware' => 'isPV'], function () {
    //     // thực đơn
    //     Route::resource('order', 'OrderController');
    //     Route::get('giaodienDB', 'OrderController@giaodienDB')->name('giaodienDB');
    //     Route::get('order/table_status', 'OrderController@table_status')->name('order.table_status');

    //     Route::post('order/orderFood', 'OrderController@orderFood')->name('order.orderFood');
    //     Route::post('order/deleteOrder', 'OrderController@deleteOrder')->name('order.deleteOrder');
    //     Route::post('order/updateSoluong', 'OrderController@updateSoluong')->name('order.updateSoluong');
    //     Route::post('order/changeQuantityIn', 'OrderController@changeQuantityIn')->name('order.changeQuantityIn');
    //     Route::post('order/changeQuantityDe', 'OrderController@changeQuantityDe')->name('order.changeQuantityDe');
    //     Route::post('order/confirmOrder', 'OrderController@confirmOrder')->name('order.confirmOrder');
    // });


    Route::resource('/ban', 'BanController');
    Route::resource('/danhmuc', 'DanhMucController');
    Route::resource('/monan', 'MonanController');

    // hóa đơn
    Route::get('hdtaiquay', 'HoaDonController@indexHDTQ')->name('hdtaiquay.indexHDTQ');
    Route::get('hdonline', 'HoaDonController@indexHDO')->name('hdonline.indexHDO');
    Route::get('hdtaiquay/{id}', 'HoaDonController@showHDTQ')->name('hdtaiquay.showHDTQ');
    Route::get('hdonline/{id}', 'HoaDonController@showHDO')->name('hdonline.showHDO');
    Route::delete('hdtaiquay/deleteHD/{id}', 'HoaDonController@deleteHD')->name('hdtaiquay.deleteHD');
    Route::delete('hdonline/deleteHDO/{id}', 'HoaDonController@deleteHDO')->name('hdonline.deleteHDO');
    Route::delete('hdtaiquay/deleteCTHD/{id}', 'HoaDonController@deleteCTHD')->name('hdtaiquay.deleteCTHD');
    // Route::post('hdtaiquay/thanhtoanhdtq/{id}', 'HoaDonController@thanhtoanhdtq')->name('hdtaiquay.thanhtoanhdtq');
    Route::put('hdtaiquay/{id}/thanhtoan', 'HoaDonController@thanhtoanhdtq');
    // Route::post('hdonline/thanhtoanon/{id}', 'HoaDonController@thanhtoanon')->name('hdonline.thanhtoanon');
    Route::get('hdtaiquay/showReceipt/{id}', 'HoaDonController@showReceipt')->name('hdtaiquay.showReceipt');

    // báo cáo
    Route::get('baocao', 'BaoCaoController@index')->name('baocao.index');

    // thực đơn
    Route::resource('order', 'OrderController');
    Route::get('giaodienDB', 'OrderController@giaodienDB')->name('giaodienDB');
    Route::get('order/table_status', 'OrderController@table_status')->name('order.table_status');

    Route::post('order/orderFood', 'OrderController@orderFood')->name('order.orderFood');
    Route::post('order/deleteOrder', 'OrderController@deleteOrder')->name('order.deleteOrder');
    Route::post('order/updateSoluong', 'OrderController@updateSoluong')->name('order.updateSoluong');
    Route::post('order/changeQuantityIn', 'OrderController@changeQuantityIn')->name('order.changeQuantityIn');
    Route::post('order/changeQuantityDe', 'OrderController@changeQuantityDe')->name('order.changeQuantityDe');
    Route::post('order/confirmOrder', 'OrderController@confirmOrder')->name('order.confirmOrder');

    Route::get('/user', 'UserController@getUser');
    // Route::get('/khachhang', 'KhachHangController@getKH');
    Route::post('/logout', 'UserController@logout');

    Route::post('/khachhang/logout', 'KhachHangController@logout')->name('khachhang.logout');

    Route::post('checkout', 'GiaoDienController@checkout')->name('checkout');
});
Route::get('order/getSaleDetails/{id}', 'OrderController@getSaleDetails')->name('order.getSaleDetails');