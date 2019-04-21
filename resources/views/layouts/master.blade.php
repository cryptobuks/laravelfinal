<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', "BookShop")</title>

<link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/font-awesome.min.css')}}">
<link rel="stylesheet" href="{{ asset('vendor/toastr/toastr.min.css')}}">
<link rel="stylesheet" href="{{ asset('css/style.css')}}">
<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/angular.min.js') }}"></script>
<script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('js/Chart.min.js') }}"></script>
</head>
<body>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <div class="container">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="navbar-header">
                <h4 class="navbar-brand">BookShop</h4>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav ">
                    <li><a href="{{URL::to('home')}}">หน้าแรก</a></li>
                    <li><a href="#">ข้อมูลสินค้า</a></li>
                </ul>
                <ul class="nav navbar-nav pull-right">                
                    @guest
                    <li class="nav navbar-nav"><a href="{{route('login')}}">เข้าสู่ระบบ</a></li>
                    <li><a href="{{route('register')}}">สมัครสมาชิก</a></li>
                    @else
                    <li><a href="#">{{Auth::user()->name}}</a></li>
                    
                    <li><a href="{{URL::to('logout')}}">ออกจากระบบ</a></li>
                    @endguest
                    <li><a href="#"><i class="fa fa-shopping-cart"></i>
                    ตะกร้า <span class="label label-danger">{!! count(Session::get('cart_items')) !!}</span>
                    </a></li>
                </ul>
            </div>
        </nav>

        @yield("content")
        
    </div>
    
</body>
</html>