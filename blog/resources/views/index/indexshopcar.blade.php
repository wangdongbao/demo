@extends('master')
@section('title',"宝的潮购")
@section('content')
    <input name="hidUserID" type="hidden" id="hidUserID" value="-1" />
    <div>
        <!--首页头部-->
        <div class="m-block-header">
            <a href="/" class="m-public-icon m-1yyg-icon"></a>
            <a href="/" class="m-index-icon">编辑</a>
        </div>
        <!--首页头部 end-->
        <div class="g-Cart-list" id="deladd">
            <ul id="cartBody">

                @foreach($goods as $v)
                    <input type="hidden" id="_token" value="{{csrf_token()}}">
                    <li  id="del" goods_id={{$v->goods_id}} cart_id={{$v->cart_id}}>
                        <s class="xuan current" cart_id={{$v->cart_id}}></s>
                        <a class="fl u-Cart-img" href="{{url('index/shopcontent/'.$v->goods_id)}}" >

                            <img src="{{url($v->goods_img)}}" border="0" alt="">
                        </a>
                        <div class="u-Cart-r">
                            <a href="/v44/product/12501977.do" class="gray6">{{$v->goods_name}}{{$v->desc}}</a>
                            <span class="gray9">
                            <em>剩余{{$v->goods_num-$v->buy_num}}件</em>
                        </span>

                            <div class="num-opt">
                                <em class="num-mius dis min"><i></i></em>

                                <input class="text_box" name="num" maxlength="6" self="{{$v->self_price}}" type="text" value={{$v->buy_num}} codeid="12501977">
                                <em class="num-add add"><i></i></em>
                            </div>
                            <a href="javascript:;" name="delLink" cid="12501977" isover="0" goods_id={{$v->goods_id}} class="z-del"><s></s></a>
                        </div>
                    </li>
                @endforeach


            </ul>
            <div id="divNone" class="empty "  style="display: none"><s></s><p>您的购物车还是空的哦~</p><a href="https://m.1yyg.com" class="orangeBtn">立即潮购</a></div>
        </div>
        <div id="mycartpay" class="g-Total-bt g-car-new" style="">
            <dl>
                <dt class="gray6">
                    <s class="quanxuan current"  ></s>全选
                    <p class="money-total">合计￥<em class="orange total"></em></p>

                </dt>
                <dd>
                    <a href="javascript:;" id="a_payment" class="orangeBtn w_account remove alldel">删除</a>
                    <a href="javascript:;" id="a_payment" class="orangeBtn w_account payment">去结算</a>
                </dd>
            </dl>
        </div>
        <div class="footer clearfix">
            <ul>
                <li class="f_home"><a href="{{url('index')}}" ><i></i>潮购</a></li>
                <li class="f_announced"><a href="{{url('index/indexshop')}}" ><i></i>全部商品</a></li>

                <li class="f_car"><a id="btnCart" href="{{url('index/indexshopcar')}}" class="hover"><i></i>购物车</a></li>
                <li class="f_personal"><a href="{{url('index/indexuser')}}" ><i></i>我的潮购</a></li>
            </ul>
        </div>
    </div>
@endsection
<script src="{{url('layui/layui.js')}}"></script>
<script src="{{url('js/jquery-3.1.1.min.js')}}"></script>
@section("my-js")
    <!---商品加减算总数---->
    <script type="text/javascript">
        $(function () {
            $(".add").click(function () {
                var t = $(this).prev();
                t.val(parseInt(t.val()) + 1);
                GetCount();
            })
            $(".min").click(function () {
                var t = $(this).next();
                if(t.val()>1){
                    t.val(parseInt(t.val()) - 1);
                    GetCount();
                }
            })
        })
    </script>
    <script>

        // 全选
        $(".quanxuan").click(function () {

            if($(this).hasClass('current')){
                $(this).removeClass('current');
                $(".g-Cart-list .xuan").each(function () {
                    if ($(this).hasClass("current")) {
                        $(this).removeClass("current");
                    } else {
                        $(this).addClass("current");
                    }
                });
                GetCount();
            }else{
                $(this).addClass('current');

                $(".g-Cart-list .xuan").each(function () {
                    $(this).addClass("current");
                    // $(this).next().css({ "background-color": "#3366cc", "color": "#ffffff" });
                });
                GetCount();
            }


        });
        //单删
        $(document).on('click','.z-del',function(){
            var goods_id=$(this).attr('goods_id');

            var _token=$('#_token').val();
            $.post(
                "{{url('index/cartdel')}}",
                {goods_id:goods_id,_token:_token},
                function(res){
                    // console.log(res);
                    if(res==1){

                        alert('删除成功');
                        $('#del').remove();
                    }
                }
            )
        });
        //批删
        $('.alldel').click(function(){
            var _li=$("s[class='xuan current']").parent('li');
            var _token=$('#_token').val();
            var goods_id='';
            _li.each(function (index) {
                goods_id+=$(this).attr('cart_id')+',';
            })
            $.post(
                "{{url('index/somedel')}}",
                {cart_id:goods_id,_token:_token},
                function(res){
                    if(res==1){
                        alert('删除成功');
                        history.go(0);
                        //location.href="shopcart";
                    }else {
                        alert('删除失败');
                        //location.href="";
                    }
                }
            )
        })
        // 单选
        $(".g-Cart-list .xuan").click(function () {

            if($(this).hasClass('current')){


                $(this).removeClass('current');

            }else{
                $(this).addClass('current');
            }
            if($('.g-Cart-list .xuan.current').length==$('#cartBody li').length){
                $('.quanxuan').addClass('current');

            }else{
                $('.quanxuan').removeClass('current');
            }
            // $("#total2").html() = GetCount($(this));
            GetCount();
            //alert(conts);
        });
        //结算
        $('.payment').click(function(){
            var cart_id='';
            $('.current').each(function(){
                cart_id+=$(this).attr('cart_id')+',';
            })

            $.post(
                "/order/pay",
                {_token:'{{csrf_token()}}',cart_id:cart_id},
                function(res){
                    console.log(res);

                    location.href='/order/payment/'+res;

                }
            )
        })
        // 已选中的总额
        function GetCount() {
            var conts = 0;
            var aa = 0;
            var prices=0;
            $(".g-Cart-list .xuan").each(function () {
                if ($(this).hasClass("current")) {
                    for (var i = 0; i < $(this).length; i++) {
                        var prices= parseInt($(this).parents('li').find('input.text_box').val());

                        conts += parseInt($(this).parents('li').find('input.text_box').attr('self'))*prices;
                        // aa += 1;
                    }

                }
            });
            // console.log(conts);
            // console.log(prices);
            // exit;
            $(".total").html('<span>￥</span>'+(conts).toFixed(2));
        }

        GetCount();
    </script>
@endsection
