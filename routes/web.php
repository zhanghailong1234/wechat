<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//微信公众号路由
Route::any("wechat/index","WechatController@index");
Route::any("week/show","WeekController@show");
Route::any("days/index","DaysController@index");
Route::any("days/ucenter","DaysController@ucenter");
Route::any("kaoshi/list","KaoshiController@list");
Route::any("kaoshi/show","KaoshiController@show");
//登录路由
Route::any("admin/login","Admin\LoginController@login");
Route::any("admin/loginDo","Admin\LoginController@loginDo");
Route::any("admin/send","Admin\LoginController@send");
Route::any("admin/loginBind","Admin\LoginController@loginBind");
Route::any("admin/loginBindDo","Admin\LoginController@loginBindDo");

//后台路由
Route::prefix("admin/")->middleware('checklogin')->group(function(){
//后台首页路径
Route::any("index","Admin\IndexController@index");
//后台管理员路径
Route::any("weather","Admin\AdminController@weather");
Route::any("getWeather","Admin\AdminController@getWeather");
Route::any("adminAdd","Admin\AdminController@adminAdd");
Route::any("adminCreate","Admin\AdminController@adminCreate");
Route::any("adminIndex","Admin\AdminController@adminIndex");
Route::any("roleAdd","Admin\AdminController@roleAdd");
Route::any("roleCreate","Admin\AdminController@roleCreate");
Route::any("roleIndex","Admin\AdminController@roleIndex");
Route::any("powerAdd","Admin\AdminController@powerAdd");
Route::any("powerCreate","Admin\AdminController@powerCreate");
Route::any("powerIndex","Admin\AdminController@powerIndex");
Route::any("selectRole/{user_id}","Admin\AdminController@selectRole");
Route::any("seleRole","Admin\AdminController@seleRole");
Route::any("selectPower/{role_id}","Admin\AdminController@selectPower");
Route::any("selePower","Admin\AdminController@selePower");
//后台素材路径
Route::any("mediaAdd","Admin\MediaController@mediaAdd");
Route::any("mediaCreate","Admin\MediaController@mediaCreate");
Route::any("mediaIndex","Admin\MediaController@mediaIndex");
//后台渠道路由
Route::any("channelAdd","Admin\ChannelController@channelAdd");
Route::any("channelCreate","Admin\ChannelController@channelCreate");
Route::any("channelIndex","Admin\ChannelController@channelIndex");
//后台太菜单管理
Route::any("menuAdd","Admin\MenuController@menuAdd");
Route::any("menuCreate","Admin\MenuController@menuCreate");
Route::any("menuIndex","Admin\MenuController@menuIndex");
Route::any("menuWechat","Admin\MenuController@menuWechat");

//首次回复管理
Route::any("firstAdd","Admin\FirstController@firstAdd");
Route::any("firstCreate","Admin\FirstController@firstCreate");
Route::any("firstIndex","Admin\FirstController@firstIndex");
Route::any("getMedia","Admin\FirstController@getMedia");

//商品管理模块/分类
Route::any("cateAdd","Admin\CategoryController@cateAdd");
Route::any("cateCreate","Admin\CategoryController@cateCreate");
Route::any("cateIndex","Admin\CategoryController@cateIndex");
Route::any("cateDelete/{cate_id}","Admin\CategoryController@cateDelete");
Route::any("cateUpdate/{cate_id}","Admin\CategoryController@cateUpdate");
Route::any("cateEdit","Admin\CategoryController@cateEdit");
//类型
Route::any("typeAdd","Admin\TypeController@typeAdd");
Route::any("typeCreate","Admin\TypeController@typeCreate");
Route::any("typeIndex","Admin\TypeController@typeIndex");
Route::any("typeDelete/{type_id}","Admin\TypeController@typeDelete");
Route::any("typeUpdate/{type_id}","Admin\TypeController@typeUpdate");
Route::any("typeEdit","Admin\TypeController@typeEdit");
//属性
Route::any("attrAdd","Admin\AttributeController@attrAdd");
Route::any("attrCreate","Admin\AttributeController@attrCreate");
Route::any("attrIndex","Admin\AttributeController@attrIndex");
Route::any("attrShow/{type_id}","Admin\AttributeController@attrShow");
Route::any("attrDelete/{type_id}","Admin\AttributeController@attrDelete");
Route::any("attrDele","Admin\AttributeController@attrDele");
Route::any("attrUpdate/{type_id}","Admin\AttributeController@attrUpdate");
Route::any("attrEdit","Admin\AttributeController@attrEdit");
//商品
Route::any("goodsAdd","Admin\GoodsController@goodsAdd");
Route::any("goodsCreate","Admin\GoodsController@goodsCreate");
Route::any("goodsIndex","Admin\GoodsController@goodsIndex");
Route::any("getattr","Admin\GoodsController@getattr");
Route::any("goodsProduct/{goods_id}","Admin\GoodsController@goodsProduct");
Route::any("goodsProductDo","Admin\GoodsController@goodsProductDo");
Route::any("goodsIndex","Admin\GoodsController@goodsIndex");
Route::any("mychange","Admin\GoodsController@mychange");
Route::any("changevalue","Admin\GoodsController@changevalue");





Route::any("getUser","Admin\LableController@getUser");
});
Route::any("admin/test","Admin\LableController@test");
Route::any("admin/auth","Admin\LableController@auth");




Route::any("api/testAdd",function(){
	return view('api/testAdd');
});
Route::any("api/testIndex",function(){
	return view('api/testIndex');
});

Route::any("api/testUpdate",function(){
	return view('api/testUpdate');
});






Route::any("test/testadd",function(){
	return view('test/testadd');
});


Route::any("test/fileadd",function(){
	return view('test/fileadd');
});
Route::any("admin/contractAdd","Admin\ContractController@contractAdd");
Route::any("admin/contractCreat","Admin\ContractController@contractCreat");
Route::any("admin/contractIndex","Admin\ContractController@contractIndex");