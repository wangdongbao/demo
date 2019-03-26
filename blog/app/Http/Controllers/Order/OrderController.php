<?php

namespace App\Http\Controllers\Order;
use App\Model\Area;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Cart;
use App\Model\Goods;
class OrderController extends Controller
{
    //潮购记录
    public function buyrecord()
    {
        return view('order.buyrecord');
    }

    //我的钱包
    public function mywallet()
    {
        return view('order.mywallet');
    }
    //晒单
    public function willshare()
    {
        return view('order.willshare');
    }
    //修改昵称
public function nicknamemodify()
{
    return view('order.nicknamemodify');
}

public function pay(Request $request)
{
    $cart_id=$request->cart_id;
    echo $cart_id;
}
//结算
public function payment($id)
{


    $cart_id=explode(',',rtrim($id,','));

    $data=Cart::whereIn('cart_id',$cart_id)->get();
// print_r($data);die;
    $goods_id=[];
    foreach($data as $k=>$v){
        $goods_id[]=$v['goods_id'];
    }
    $goodsinfo=Goods::whereIn('goods_id',$goods_id)->get();
    $goods=Goods::join('cart','goods.goods_id','=','cart.goods_id')->get();
    $price=0;
    foreach($goods as $v){
        $info=$price+=$v['self_price']*$v['buy_num'];
    }
    //print_r($goodsinfo);
    return view('order.payment',['goodsinfo'=>$goodsinfo,'info'=>$info]);
}

}