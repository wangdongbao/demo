<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Address;
use App\Model\Area;

class AddressController extends Controller
{
    /*
    * @地址管理
    * */
    public function address()
    {
    	$address=new address;
    	$addressinfo=$address::where('address_status',1)->get();
    	//print_r($addressinfo);
        return view("address.address",['addressinfo'=>$addressinfo]);
    }
    /*
    * @地址添加
    * */
    public function addressadd()
    {
    	
        return view("address.addressadd");
    }
    /*
    * @地址添加
    * */
    public function addressdo(Request $request)
    {	
    	$data=$request->all();
//    	print_r($data);die;
    	$data['user_id']=session('user_id');
    	unset($data['_token']);
    	$address=new address;
    	if($data['is_default']==1){
    		$res=$address::where('user_id',$data['user_id'])->update(['is_default'=>2]);
    		$res2=$address::insert($data);
    		if($res2){
    			echo 1;
    		}else{
    			echo 2;
    		}
    	}else{
    		$res=$address::insert($data);
    		if($res){
    			echo 1;
    		}else{
    			echo 2;
    		}
    	}
    }
    /*
    * @地址删除
    * */
    public function addressdel(Request $request)
    {
    	$address_id=$request->address_id;
    	//echo $address_id;
    	$user_id=session('user_id');
    	$where=[
    		'user_id'=>$user_id,
    		'address_id'=>$address_id
    	];
    	$address=new address;
    	$res=$address::where($where)->update(['address_status'=>2]);
    }	
    /*
    * @地址修改
    * */
    public function addressup($id)
    {	
    	$user_id=session('user_id');
    	$where=[
    		'user_id'=>$user_id,
    		'address_id'=>$id
    	];
    	$address=new address;
    	$res=$address::where($where)->get();
    	return view('address.addressup',['res'=>$res]);
    }
    /*
    * @地址修改
    * */
    public function addressupdo(Request $request)
    {
    	$data=$request->all();
    	//print_r($data);
    	$data['user_id']=session('user_id');
    	$where=[
    		'user_id'=>$data['user_id'],
    		'address_id'=>$data['address_id']
    	];
    	unset($data['_token']);
    	$address=new address;
    	if($data['is_default']==1){
    		$res=$address::where('user_id',$data['user_id'])->update(['is_default'=>2]);
    		$res2=$address::where($where)->update($data);
    		if($res2){
    			echo 1;
    		}else{
    			echo 2;
    		}
    		//print_r($res2);
    	}else{
    		$res=$address::where($where)->update($data);
    		if($res){
    			echo 1;
    		}else{
    			echo 2;
    		}
    		//echo 3;
    	}
    }
    /*
    * @改变默认地址
    * */
    public function addressmoren(Request $request)
    {
    	$id=$request->address_id;
    	$user_id=session('user_id');
    	$where=[
    		'address_id'=>$id,
    		'user_id'=>$user_id
    	];
    	$address=new address;
    	$res2=$address::where('user_id',$user_id)->update(['is_default'=>2]);
    	$res=$address::where($where)->update(['is_default'=>1]);
    	//echo $id;
    }
}
