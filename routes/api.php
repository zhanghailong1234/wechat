<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get("/test_Create","Api\TestController@testCreate");
Route::get("/test_Index","Api\TestController@testIndex");

//修改接口
Route::get("/test_Find","Api\TestController@testFind");
Route::get("/test_Update","Api\TestController@testUpdate");
Route::any("/test_Edit","Api\TestController@testEdit");
Route::any("/test_delete","Api\TestController@delete");



Route::resource('test2','Api\Test2Controller');



//封装接口
Route::get("/Create","Test\Test3Controller@create");

//商品管理接口
Route::get("/getNew_goods","Api\GoodsController@getNewGoods");
Route::get("/get_cate","Api\GoodsController@getCate");
Route::get("/show_goods","Api\GoodsController@showgoods");
Route::get("/categoods","Api\GoodsController@categoods");
Route::get("/goodsinfo","Api\GoodsController@goodsinfo");
//登录接口

Route::middleware(["access"])->group(function(){
	Route::get("/login","Api\UsersController@login");

	Route::middleware(["userslogin"])->group(function(){
	
	Route::get("/addCart","Api\GoodsController@addCart");
	Route::get("/cartList","Api\GoodsController@cartList");
	Route::get("/cartShow","Api\GoodsController@cartShow");
	Route::get("/address","Api\GoodsController@address");
	Route::get("/newaddress","Api\GoodsController@newaddress");
	Route::get("/checkaddress","Api\GoodsController@checkaddress");
});	
});