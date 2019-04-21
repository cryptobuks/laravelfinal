@extends('layouts.master')
@section('title') BookShop @stop
@section('content')

<div class="container">
    <h1>รายการสินค้า</h1>
    <div class="panel-body">
    <form action="{{ URL::to('product/search') }}" method="post" class="form-inline">
    {{ csrf_field() }}
    <input type="text" name="q" class="form-control" placeholder="...">
    <button type="submit" class="btn btn-primary">ค้นหา</button>
    </form>
    </div>
    <table class="table table-bordered bs-table">
        <thead>
            <tr>
                <th>ชื่อสินค้า</th>
                <th>ประเภทสินค้า</th>
                <th>ราคา</th>
                <th>คงเหลือ</th>
                <th>รูปภาพ</th>
                <th>แก้ไข</th>
                <th>ลบ</th>
            </tr>
        </thead>
        <tbody>

            @foreach($products as $p)
            <tr>
            <td>{{ $p->title }}</td>
            @if( $p->booktype_id=="1") <td>นวนิยาย</td>
            @endif
            @if( $p->booktype_id=="2") <td>การ์ตูน</td>
            @endif
            @if( $p->booktype_id=="3") <td>บัญชี</td>
            @endif
            <td>{{ $p->price }}</td>
            <td>{{ $p->stock_qty }}</td>
            <td><img src="{{ asset($p->image_url) }}" width="100px"></td>
            <td><a href="{{ URL::to('product/edit/'.$p->id) }}" class="btn btn-info">
            <i class="fa fa-edit">แก้ไข</i></a>
            </td>
            <td><a href="#" class="btn btn-danger btn-delete" id-delete="{{ $p->id }}">
                <i class="fa fa-trash">ลบ</i></a>
            </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
$('.btn-delete').on('click', function(){
    if(confirm('คุณต้องการลบสินค้าหรือไม่?')){
        var url = "{{ URL::to('product/remove') }}"
        +'/'+$(this).attr('id-delete');
        window.location.href = url;
    }
});
</script>

@endsection