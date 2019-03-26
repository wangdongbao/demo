<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>填写收货地址</title>
    <meta content="app-id=984819816" name="apple-itunes-app" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <link href="{{url('css/comm.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{url('css/writeaddr.css')}}">
    <link rel="stylesheet" href="{{url('layui/css/layui.css')}}">
    <link rel="stylesheet" href="{{url('dist/css/LArea.css')}}">
</head>
<body>
    
<!--触屏版内页头部-->
<div class="m-block-header" id="div-header">
    <strong id="m-title">填写收货地址</strong>
    <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
    <a href="javascript:;" class="m-index-icon">修改</a>
</div>
<div class=""></div>
<!-- <form class="layui-form" action="">
  <input type="checkbox" name="xxx" lay-skin="switch">  
  
</form> -->
<form class="layui-form" action="">
  @foreach($res as $v)
  <input type="hidden" class="address_id" value="{{$v->address_id}}">
  <div class="addrcon">
    <ul>
      <li><em>收货人</em><input type="text" placeholder="请填写真实姓名" value="{{$v->address_name}}" id="address_name"></name="address_area"li>
      <li><em>手机号码</em><input type="number" placeholder="请输入手机号" value="{{$v->address_tel}}" id="address_tel"></li>
      <li><em>所在区域</em><input  type="text"  id="address_area" value="{{$v->address_area}}" placeholder="请选择所在区域"></li>
      <li class="addr-detail"><em>详细地址</em><input type="text" value="{{$v->address_detail}}" placeholder="20个字以内" id="address_detail" class="addr"></li>
    </ul>
    @if($v->is_default==1)
    <div class="setnormal"><span>设为默认地址</span><input type="checkbox" id="is_default" checked lay-skin="switch">  </div>
    @else
    <div class="setnormal"><span>设为默认地址</span><input type="checkbox" id="is_default" lay-skin="switch">  </div>
    @endif
  </div>
 @endforeach 
</form>

<!-- SUI mobile -->

<!-- <script src="{{url('dist/js/LArea.js')}}"></script> -->
<script src="{{url('dist/js/LAreaData1.js')}}"></script>
<script src="{{url('dist/js/LAreaData2.js')}}"></script>
<script src="{{url('js/jquery-1.11.2.min.js')}}"></script>
<script src="{{url('layui/layui.js')}}"></script>

<script>
  //Demo
layui.use('form', function(){
  var form = layui.form();
  //console.log(1)
  //监听提交
  form.on('submit(formDemo)', function(data){
    layer.msg(JSON.stringify(data.field));
    return false;
  });
});
// var area = new LArea();
// area.init({
//     'trigger': '#demo1',//触发选择控件的文本框，同时选择完毕后name属性输出到该位置
//     'valueTo':'#value1',//选择完毕后id属性输出到该位置
//     'keys':{id:'id',name:'name'},//绑定数据源相关字段 id对应valueTo的value属性输出 name对应trigger的value属性输出
//     'type':1,//数据源类型
//     'data':LAreaData1//数据源
// });


</script>
<script type="text/javascript">
  $(function(){
    $('.m-index-icon').click(function(){
        var address_id=$('.address_id').val();
        var address_name=$('#address_name').val();
        var address_tel=$('#address_tel').val();
        var address_area=$('#address_area').val();
        var address_detail=$('#address_detail').val();
        var is_default=$('#is_default').prop('checked');
        //console.log(add)
        if(is_default==true){
          is_default=1
        }else{
          is_default=2
        }
        if(address_name==''){
            alert('姓名不能为空');
            return false;
        }
        if(address_tel==''){
            alert('联系方式不能为空');
            return false;
        }
        if(address_area==''){
            alert('收货地址不能为空');
            return false;
        }
        if(address_detail==''){
            alert('详细地址不能为空');
            return false;
        }
        

        $.post(
            "{{url('address/addressupdo')}}",
            {address_name:address_name,address_tel:address_tel,address_detail:address_detail,address_area:address_area,is_default:is_default,_token:'{{csrf_token()}}',address_id:address_id},
            function(res){
              if(res==1){
                alert('修改地址成功')
                location.href="{{url('address/address')}}";
              }else{
                alert('修改地址失败')
              }
            }
        )
    })
  })
</script>

</body>
</html>
