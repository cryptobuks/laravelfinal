@extends('layouts.master')
@section('title') BookShop @stop

@section('content')

<div class="container">
    <h1>รายงาน</h1>
    <ul class="breadcrumb">
        <li><a href="{{URL::to('product')}}">หน้าแรก</a></li>
        <li class="active">รายงาน</li>
    </ul>
</div>
<div class="panel panel-default">
    
    <div class="row">
        <div class="col-md-6">
                <div class="panel panel-heading">
                        <div class="panel-title"><strong>มูลค่าสินค้า</strong></div>
                
                    </div>
                <div class="panel-body"><canvas id="myChart" height="100"></canvas></div>
        </div>
        <div class="col-md-6">
                <div class="panel panel-heading">
                        <div class="panel-title"><strong>มูลค่าสินค้าแยกตามประเภท</strong></div>
                
                    </div>
                <div class="panel-body"><canvas id="pieChart" height="100"></canvas></div>
        </div>
    </div>
    
</div>
<script type="text/javascript">
    $.get("/api/product/chart/list",function (response) {
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx,{
            type:'bar',
            data:{
                    labels:response.product_names,
                    datasets:[{
                        label:'ราคาขายสินค้า',
                        data: response.product_prices,
                        backgroundColor:[
                            'rgb(255,99,132,1.0)',
                            'rgb(54,162,132,1.0)',
                        ]
                    }]
            },
            options:{scales:{ yAxes : [{ticks:{ beginAtZero:true }}] }}
        });
    });


    $.get("/api/category/chart/list",function (response) {
        var ctx = document.getElementById("pieChart").getContext('2d');
        var myChart = new Chart(ctx,{
            type:'pie',
            data:{
                    labels:response.cat_names,
                    datasets:[{
                        label:'ราคาขายสินค้า',
                        data: response.cat_prices,
                        backgroundColor:[
                            'rgba(255,99,132,1.0)',
                            'rgba(54,162,132,1.0)',
                            'rgba(99,99,99,1.0)',
                        ]
                    }]
            },
            options:{scales:{ yAxes : [{ticks:{ beginAtZero:true }}] }}
        });
    });


</script>

@stop