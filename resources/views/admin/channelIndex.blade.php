@extends('layout.layout')

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<h1>渠道管理-菜单列表</h1>
	<table class="table table-hover" style="margin-top: 50px">
  	<tr>
  		<th>ID</th>
  		<th>渠道名称</th>
  		<th>渠道标识</th>
      <th>二维码图片</th>
      <th>关注人数</th>
  		<th>添加时间</th>
  		<th>操作</th>
  	</tr>
  	@foreach($data as $v)
  	<tr>
  		<td>{{$v->channel_id}}</td>
  		<td>{{$v->channel_name}}</td>
  		<td>{{$v->channel_status}}</td>  
  		<td><img class="click_img" src="https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket={{$v->ticket}}" width="50px"></td>
      <td>{{$v->people}}</td>
  		<td>{{$v->created_at}}</td>
  		<td><button class="btn btn-success"><a href="#">编辑</a></button>
  			<button class="btn btn-danger"><a href="#">删除</a></button>			
  		</td>
  	</tr>
  	@endforeach
	</table>
	{{$data->links()}}

  

      <!-- 图表容器 DOM -->
    <div id="container" style="width: 600px;height:400px;"></div>
    <!-- 引入 highcharts.js -->
    <script src="http://cdn.highcharts.com.cn/highcharts/highcharts.js"></script>
    <script>
        // 图表配置
        var options = {
            chart: {
                type: 'bar'                          //指定图表的类型，默认是折线图（line）
            },
            title: {
                text: '各渠道关注人数统计'                 // 标题
            },
            xAxis: {
                categories: [<?php echo $nameStr;?>]   // x 轴分类
            },
            yAxis: {
                title: {
                    text: '关注数量'                // y 轴标题
                }
            },
            series: [{                              // 数据列
                name: '公众号关注数量',                        // 数据列名
                data: [{{$numStr}}]                     // 数据
            
            }]
        };
        // 图表初始化函数
        var chart = Highcharts.chart('container', options);
    </script>

</body>
</html>
