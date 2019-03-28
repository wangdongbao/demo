<?php

namespace App\Http\Controllers\Index;

use App\Model\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Goods;
use Illuminate\Support\Facades\DB;
use App\Model\Cart;
class IndexController extends Controller
{
    protected static $arrCate;
    /*
     * @微商城前台Index
     * */
    public function index()
    {
        $model=new Goods();
        $data=$model::get();
        $cate_model=new Category();
        $cate=$cate_model->where('p_id','=','0')->get();
        return view("index.index",['data'=>$data],['cate'=>$cate]);
    }
    /*
     * @商品列表加条件
     * */
    public function indexshopid($id)
    {
        $cate_model=new Category();
        $cate=$cate_model->where('p_id','=','0')->get();
        //print_r($cate);die;
        $this->get($id);
        $arr=self::$arrCate;
        //print_r($arr);die;
        $data=DB::table("goods")->whereIn('cate_id',$arr)->get();
        return view("index.indexshop",['data'=>$data],['cate'=>$cate]);
    }

    /*
     * @商品列表
     * */
    public function indexshop()
    {
        $model=new Goods();
        $data=$model::get();
        $cate_model=new Category();
        $cate=$cate_model->where('p_id','=','0')->get();
        //print_r($cate);die;
        return view("index.indexshop",['data'=>$data],['cate'=>$cate]);
    }
    /*
     * @商品列表ajax
     * */
    public function indexshopajax(Request $request)
    {
        $cate_id=$request->cate_id;
        //print_r($cate);die;
        $this->get($cate_id);
        $arr=self::$arrCate;
        //print_r($arr);die;
        $data=DB::table("goods")->whereIn('cate_id',$arr)->get();
        //print_r($cate);die;
        return view("index.shopdiv",['data'=>$data]);
    }
    /*
     * @商品列表is_new
     * */
    public function isnew()
    {
        $data=DB::table("goods")->where("is_new","=","1")->get();
        //print_r($cate);die;
        return view("index.shopdiv",['data'=>$data]);
    }
    /*
     * @商品列表price
     * */
    public function price(Request $request)
    {

        $type=$request->type;
        if($type==1){
            $data=DB::table("goods")->orderBy("self_price","desc")->get();
        }else{
            $data=DB::table("goods")->orderBy("self_price","asc")->get();
        }
        //print_r($cate);die;
        return view("index.shopdiv",['data'=>$data]);
    }
    /*
     *
     * */
    public function get($id)
    {
        $arrIds=DB::table("category")->select("cate_id")->where("p_id",$id)->get();
        //print_r($arrIds);die;
        if(count($arrIds)!=0){
            foreach($arrIds as $k=>$v){
                $cateId=$v->cate_id;
                $Ids=$this->get($cateId);
                //print_r($Ids);die;
                self::$arrCate[]=$Ids;
            }


        }
        if(count($arrIds)==0){
            return $id;
        }
    }






    /*
     * @我的潮购
     * */
    public function indexuser()
    {
        return view("index.indexuser");
    }
    /*
     * @商品详情页
     * */
    public function indexcontent($id)
    {
        $model=new Goods();
        $data=$model->where("goods_id",'=',$id)->get();
//        $user_id=   session(['user_id'=>$arr['user_id']]);
        return view("index.shopcontent",['data'=>$data]);
    }
    //添加购物车
    public function cartadd(Request $request)
    {
        $user_id=session('user_id');

        if(empty($user_id)) {
            echo 3;exit;
        }
        $goods_id=$request->goods_id;
        $onegoods=Cart::where('goods_id',$goods_id)->first();
        if($onegoods!=''){
            $data=[
                'buy_num'=>$onegoods['buy_num']+1
            ];
            $res=Cart::where('goods_id',$goods_id)->update($data);
        }else{
            $data=[
                'user_id'=>$user_id,
                'goods_id'=>$goods_id,
                'buy_num'=>1
            ];
            $res=Cart::insert($data);
        }

        if($res){
            echo 1;
        }else{
            echo 2;exit;
        }

    }
//购物车展示
    public function indexshopcar(Request $request)
    {
        $user_id=session('user_id');

        if(empty($user_id)){
            return view('user/login');
        }else{
            $goods=Goods::join('cart','goods.goods_id','=','cart.goods_id')->where(['user_id'=>$user_id])->get();
        }
        return view("index.indexshopcar",['goods'=>$goods]);
    }
    //单删
    public function cartdel(Request $request)
    {
        $goods_id=$request->goods_id;

        $data=Cart::where('goods_id','=',$goods_id)->delete();
//      print_r($data);die;
        if($data){
            echo 1;
        }else{
            echo 2;
        }
    }
    //批删
public function somedel(Request $request)
{
    $cart_id=explode(',',rtrim($request->cart_id,','));
    $res=Cart::whereIn('cart_id',$cart_id)->delete();
    if($res){
        echo 1;
    }else{
        echo 2;
    }
}
//搜索
public function search(Request $request)
{

    $search=$request->search;
   $model=new goods;
    if($search!=''){
        $data=$model->where('goods_name','like',"%$search%")->get();
    }else{
        $data=$model->get();
    }
//  print_r($data);die;
    return view('index.div',['data'=>$data]);
}

}
