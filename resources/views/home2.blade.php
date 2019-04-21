@extends('layouts.master')
@section('title') BookShop @stop
@section('content')
<div class="container" ng-app="app" ng-controller="ctrl">
    <div class="row">
        <div class="col-md-3">
            <h1 style="margin: 0 0 30px 0">สินค้าในร้าน</h1>
            {{-- <div class="lost-group">
                <a href="#" class="list-group-item"
                ng-class="{'active': catrgory == null}"
                ng-click="getProductList(null)">ทั้งหมด</a>
                <a href="#" class="list-group-item" ng-repeat="c in categories"
                ng-class="{'active': catrgory == c.id}"
                ng-click="getProductList(c.id)">@{c.name}</a>
            </div> --}}
        </div>
        <div class="col-md-9">
            {{-- <div class="pull-right" style="margin-top:10px">
                <input type="text" class="form-control"
                ng-model = "query"
                ng-keyup="searchProduct($even)"
                style="width:190px" placeholder="พิมพ์ชื่อสินค้าที่จ้องการค้นหา">
            </div> --}}
            <div class="row">
                <div class="col-md-3" ng-repeat="p in products">

                
                <div class="panel panel-default">
                    <img src="@{ p.image_url}" class="img-responsive">
                    <div class="panel-body">
                        <h4><a href="#">@{ p.title}</a></h4>
                        <div class="form-group">
                            <div>คงเหลือ@{p.stock_qty|number:0}</div>
                            <div>ราคา@{ p.price|number:2}</div>
                        </div>
                        <a href="#" class="btn btn-success btn-block"
                        ng-click="addToCart(p)">
                    <i class="fa fa-shopping-cart"></i>หยิบสินค้าใส่ตะกร้า</a>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>

    <script type="text/javascript">
       
    </script>
    



@stop