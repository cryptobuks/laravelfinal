@extends('layouts.master')
@section('title') BookShop @stop
@section('content')

<h1>แก้ไขข้อมูล</h1>

@if($errors->any())
<div class="alert alert-danger">
    @foreach($errors->all() as $error) <div>{{ $error }}</div>@endforeach
</div>
@endif

{!! Form::model($product, array('action' => 'ProductController@update', 'method' => 'post',
'enctype' => 'multipart/form-data')) !!}
<input type="hidden" name="id" value="{{ $product->id }}">

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">
        <strong>ข้อมูลสินค้า</strong>
        </div>
    </div>
    <div class="panel-body">
        <table>
            <tr>
            <td>{{ Form::label('title', 'ชื่อสินค้า') }}</td>
            <td>{{ Form::text('title', Input::old('title'), ['class' => 'form-control']) }}</td>
            </tr>

            <tr>
                <td>{{ Form::label('booktype_id', 'รหัสสินค้า') }}</td>
                <td>{{ Form::select('booktype_id', $categories, Input::old('booktype_id'), ['class' => 'form-control']) }}</td>
            </tr>

            <tr>
           <td>{{ Form::label('price', 'ราคา') }}</td>
               <td>{{ Form::text('price', Input::old('price'), ['class' => 'form-control']) }}</td>
                  </tr>
             <tr>
             <td>{{ Form::label('stock_qty', 'จำนวน') }}</td>
            <td>{{ Form::text('stock_qty', Input::old('stock_qty'), ['class' => 'form-control']) }}</td>
          </tr>
          <tr>
          <td>{{ Form::label('image','เลือกรูปภาพสินค้า')}}</td>
          <td>{{ Form::file('image') }}</td>
          </tr>
          @if($product->image_url)
          <tr>
              <td><strong>รูปสินค้า</strong></td>
          <td><img src="{{ asset($product->image_url) }}" width="100px"></td>
          </tr>
          @endif
        </table>
    </div>

    <div class="panel-footer">
        <button type="reset" class="btn btn-danger">ยกเลิก</button>
        <button type="submit" class="btn btn-primary">บันทึก</button>
    </div>
</div>

{!! Form::close() !!}

@endsection