<?php



Route::get('/', function () {
return view('welcome');
});

/*
* @微商城首页
* */
Route::prefix('index')->group(function () {
Route::any("indexshop","Index\IndexController@indexshop");
Route::any("shopcontent/{id}","Index\IndexController@indexcontent");

});

Route::any("index/indexshopcar","Index\IndexController@indexshopcar")->Middleware('session');
Route::any("index/cartadd","Index\IndexController@cartadd");
Route::any("index/cartdel","Index\IndexController@cartdel");
Route::any("index/indexuser","Index\IndexController@indexuser");
Route::any("index/indexshop/{id}","Index\IndexController@indexshopid");
Route::any("index","Index\IndexController@Index");
Route::post("index/indexshopajax","Index\IndexController@indexshopajax");
Route::post("index/isnew","Index\IndexController@isnew");
Route::post("index/price","Index\IndexController@price");
Route::post("index/somedel","Index\IndexController@somedel");

Route::any("address/address","Index\AddressController@address");


Route::prefix('user')->group(function () {
Route::any("user","Index\UserController@user");
Route::any("login","Index\UserController@login");
Route::any("register","Index\UserController@register");
Route::any("registerdo","Index\UserController@registerdo");
Route::any("findpwd","Index\UserController@findpwd");
Route::any("resetpassword","Index\UserController@resetpassword");
Route::any("create","Index\UserController@create");
Route::any("dlicode","Index\UserController@dlicode");
});
Route::any("user/logindo","Index\UserController@logindo");


Route::prefix('order')->group(function () {
    Route::any("buyrecord","Order\OrderController@buyrecord");
    Route::any("mywallet","Order\OrderController@mywallet");
    Route::any("willshare","Order\OrderController@willshare");
    Route::any("nicknamemodify","Order\OrderController@nicknamemodify");

    Route::any("payment/{id}","Order\OrderController@payment");

    Route::any("pay","Order\OrderController@pay");
});
Route::any("address/address","Index\AddressController@address");
Route::any("address/addressadd","Index\AddressController@addressadd");
Route::any("address/addressdo","Index\AddressController@addressdo");
Route::any("address/addressdel","Index\AddressController@addressdel");
Route::any("address/addressup/{id}","Index\AddressController@addressup");
Route::any("address/addressupdo","Index\AddressController@addressupdo");
Route::any("address/addressmoren","Index\AddressController@addressmoren");