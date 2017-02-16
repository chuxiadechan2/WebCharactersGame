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

/**
 * 设置前端的路由组,前缀为/目录,控制器为IndexController.
 *
 * @author 初夏的蝉︵°
 */
Route::group(['prefix'=>'/'],function(){
    //这个是首页的路由
    Route::get('/','Web\IndexController@Index');
    //开始游戏的路由,判断服务器区组是否存在
    Route::get('joinGame/{id}','Web\IndexController@joinGame');
    //用户登录页面的路由
    Route::get('login.html','Web\IndexController@loginView');
    //用户登录函数的路由
    Route::post('loginFunction','Web\IndexController@loginFunction');
    //用户退出登录的路由
    Route::get('outLogin','Web\IndexController@outLogin');
    //显示用户注册界面的路由
    Route::get('reg.html','Web\IndexController@regView');
    //用户注册函数的方法
    Route::post('regFunction','Web\IndexController@regFunction');
    //用户验证邮箱激活的路由
    Route::get('verifyEmail/{verifyKey?}','Web\IndexController@verifyEmail');


});