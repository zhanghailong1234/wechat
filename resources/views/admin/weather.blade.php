@extends('layout.layout')
@section('content')
<h1>一周气温展示</h1>
城市:<input type="text" name="city">
<input type="button" value="搜索" id="search">(城市名可以为拼音和汉字)

	 <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
 		<script src="https://code.highcharts.com.cn/highcharts/highcharts.js"></script>
        <script src="https://code.highcharts.com.cn/highcharts/highcharts-more.js"></script>
        <script src="https://code.highcharts.com.cn/highcharts/modules/exporting.js"></script>
        <script src="https://img.hcharts.cn/highcharts-plugins/highcharts-zh_CN.js"></script>
<script>
$.ajax({
		url:"{{url('admin/getWeather')}}",
		type:"GET",
		data:{city:'北京'},
		dataType:"json",
		success:function(res){
			showweather(res.result);
		}
	})
$('#search').on("click",function(){
	
	//获取城市名
	var city=$('[name="city"]').val();

	if(city==""){
		alert("请输入城市名!");
		return;
	}
	//向后台发起ajax请求
	$.ajax({
		url:"{{url('admin/getWeather')}}",
		type:"GET",
		data:{city:city},
		dataType:"json",
		success:function(res){
			 showweather(res.result);
			
		}
	})
})
//展示天气图标
function showweather(weatherData){
console.log(weatherData);
	//根据天气数据 展示一周天气
	var daysArr=[];
	var temperature=[];
	$.each(weatherData,function(k,v){
		daysArr.push(v['days']);
		temperature.push([parseInt(v['temp_low']),parseInt(v['temp_high'])]);
	})
	var chart = Highcharts.chart('container', {
    chart: {
        type: 'columnrange', // columnrange 依赖 highcharts-more.js
        inverted: true
    },
    title: {
        text: '一周温度变化范围'
    },
    subtitle: {
        text: weatherData[0]['citynm']
    },
    xAxis: {
        categories: daysArr
    },
    yAxis: {
        title: {
            text: '温度 ( °C )'
        }
    },
    tooltip: {
        valueSuffix: '°C'
    },
    plotOptions: {
        columnrange: {
            dataLabels: {
                enabled: true,
                formatter: function () {
                    return this.y + '°C';
                }
            }
        }
    },
    legend: {
        enabled: false
    },
    series: [{
        name: '温度',
        data: temperature
    }]
});
}
</script>
@endsection