<div class="goodList mui-scroll">
    <ul id="ulGoodsList" class="mui-table-view mui-table-view-chevron">
        @foreach($data as $v)
            <li id="23468" class="id" goods_id="{{$v->goods_id}}">
                <a href="{{url('index/shopcontent/'.$v->goods_id)}}">
                                            <span class="gList_l fl">
                                                <img class="lazy" src="{{url($v->goods_img)}}">
                                            </span>
                </a>
                <div class="gList_r">
                    <h3 class="gray6">{{$v->goods_name}}</h3>
                    <em class="gray9">价值：￥{{$v->self_price}}</em>
                    <div class="gRate">
                        <div class="Progress-bar">
                            <p class="u-progress">
                                                    <span style="width: 91.91286930395593%;" class="pgbar">
                                                        <span class="pging"></span>
                                                    </span>
                            </p>
                            <ul class="Pro-bar-li">
                                <li class="P-bar01"><em>{{$v->goods_num}}</em>剩余</li>
                            </ul>
                        </div>
                        <input type="hidden" id="_token" value="{{csrf_token()}}">
                        <a codeid="12785750"  goods_id={{$v->goods_id}} class="addcart" canbuy="646"><s></s></a>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</div>