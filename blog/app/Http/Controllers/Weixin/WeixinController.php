<?php
namespace App\Http\Controllers\Weixin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;
/*
 * 第一步：填写服务器url
 * 第二步：微信服务器发送一个get请求到填写的url 携带四个参数 signature timestamp nonce echostr
 * 第三步：将token、timestamp、nonce三个参数进行字典序排序
 * 第四部： 将三个参数字符串拼接成一个字符串进行sha1加密
 * 第五步：开发者获得加密后的字符串可与signature对比，标识该请求来源于微信
 * 第六步：确认此次GET请求来自微信服务器，请原样返回echostr参数内容，则接入生效，成为开发者成功，否则接入失败
 * */

define("WEIXINTOKEN",'weixin1809B');

$wechatobj = new WeixinController();
$wechatobj->valid();

Class WeixinController extends Controller
{
    public function valid()
    {
        $echostr  =  $_GET['echostr'];
//        echo $echostr;
        if($this->CheckSignature()){
            echo $echostr;exit;
        }
    }
    private function CheckSignature()
    {
        $signature  =  $_GET['signature'];
        $timestamp =  $_GET['timestamp'];
        $nonce  =  $_GET['nonce'];

        $token = WEIXINTOKEN;

        //将三个参数写入数组
        $arr = array($token,$timestamp,$nonce);
        //字典排序
        sort($arr,SORT_STRING);
        //拼接参数
        $str = implode($arr);
        //sha1 加密
        $sign = sha1($str);
        if($sign == $signature){
            return true;
        }else{
            return false;
        }


    }
}
