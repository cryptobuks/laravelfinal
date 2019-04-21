@extends('layouts.master')
@section('title') BookShop @stop

@section('content')

<div class="container" ng-app="app" ng-controller="ctrl">
    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <a href="#" class="list-group-item"
                    ng-class="{'active': category == null}"
                    ng-click="getProductList(null)">ทั้งหมด</a>
                <a href="#" class="list-group-item" ng-repeat="c in categories"
                    ng-click="getProductList(c.id)"
                    ng-class="{'active': category == c.id}">@{ c.name }</a>
            </div>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="pull-right" style="margin-tio:10px">
                    <input type="text" class="form-control"
                        ng-model="query"
                        ng-keyup="searchProduct($event)"
                        style="width:190px" placeholder="พิมพ์ชื่อสินค้าเพื่อค้นหา">
                </div>
            </div>
            <div class="row">
                <div class="col-md-3" ng-repeat="p in products">
                    <!-- product cart -->
                    <div class="panel panel-defualt">
                        <img ng-src="@{ p.image_url }" class="img-responsive">
                        <div class="panel-body">
                            <h4><a href="#">@{ p.title }</a></h4>
                            <div class="from-group">
                                <div>คงเหลือ@{ p.stock_qty }</div>
                                <div><strong>ราคา@{ p.price|number:2 }</strong> บาท</div>
                            </div>
                            <a href="#" class="btn btn-success btn-block" ng-click="addToCart(p)">
                                <i class="fa fa-shopping-cart"></i>หยิบใส่ตะกร้า</a>
                        </div>
                    </div>
                    <!-- end cart -->
                </div>
                <h3 ng-if="!products.length"> ไม่พบข้อมูลสินค้า</h3>
            </div>
        </div>
    </div>

</div> <!-- end container -->

<script type="text/javascript">
     var app = angular.module('app', []).config(function ($interpolateProvider) {
         $interpolateProvider.startSymbol('@{').endSymbol('}');
     });

     app.controller('ctrl', function ($scope, productService) {
         $scope.products = [];
         $scope.categories = [];
         $scope.category = {};
        
         $scope.getProductList = function (category) {
             $scope.category = category;
             booktype_id = category != null ? category : '';
             productService.getProductList(booktype_id).then(function (res) {
                 
                 if(!res.data.ok)
                 return;
            $scope.products = res.data.products;
             });

         };

         $scope.getCategoryList = function (){
             productService.getCategoryList().then(function (res) {
                 if(!res.data.ok)
                 return;
            
            $scope.categories = res.data.categories;
             });
         };
         $scope.searchProduct = (e) =>{
             console.log($scope.query);
            productService.searchProduct($scope.query).then( (res) =>{
                if(!res.data.ok)
                return;
                $scope.products = res.data.products;
               
            });
         };
         $scope.addToCart = (p) => {
            window.location.href = '/cart/add/'+p.id;
         };

         $scope.getProductList(null);
         $scope.getCategoryList();
        

     });

     app.service('productService', function($http) {

         this.getCategoryList = function () {
             return $http.get('/api/category');
         };

         this.getProductList = function (booktype_id) {
             if(booktype_id) {
                 
                 return $http.get('/api/product/'+ booktype_id);
             }
             return $http.get('/api/product');
         };

         this.searchProduct = (query) =>{
           return $http({
               url: '/api/product/search',
               method: 'post',
               data :{'query':query},
               
           });
         }

     });


</script>

@stop