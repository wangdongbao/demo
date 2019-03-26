<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Common extends Model
    {
        public static function CURLGET()
        {

        }
        //CURL post请求
        public static function CURLPOST()
        {

        }
    public static function createcode($len)
    {
        $code = '';
        for($i=1;$i<=$len;$i++){
            $code .=mt_rand(0,9);
        }

        return $code;
    }
    }