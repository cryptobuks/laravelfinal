<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Books;
use App\Booktype;
use Input, Config, Validator,Session,Auth;

class ProductController extends Controller
{
    public function search(){
        $query = Input::get('q');
        if($query){
            $products = Books::where('title','like','%'.$query.'%')
            ->get();
        }else{
            $products = Books::all();
        }
        return view('product/index', compact('products'));
    }


    public function index(){
        $products = Books::all();
        return view('product/index', compact('products'));
    }
    public function logout(){
        Auth::logout();
        Session::flush();
        return redirect('/login');
    }
    public function edit($id = null){
        $categories = Booktype::pluck('name', 'id')->prepend('เลือกรายการ');

        if($id){
            $product = Books::where('id', $id)->first();
            return view('product/edit')
            ->with('product', $product)
            ->with('categories', $categories);
        }
        else {
            return view('product/add')
            ->with('categories', $categories);
        }

    }

    public function update() {
        $rules = array(
            'title' => 'required',
            'price' => 'numeric',
            'booktype_id' => 'numeric|required',
            'stock_qty' => 'numeric',

        );

        $messages = array(
            'required' => 'กรุณากรอกข้อมูลให้ครบ',
            'numeric' => 'กรุณากรอกข้อมูลให้เป็นตัวเลข',
        );

        $id = Input::get('id');

        $validator = Validator::make(Input::all(),$rules, $messages);
        if($validator->fails()){
            return redirect('product/edit/'.$id)
            ->withErrors($validator)
            ->withInput();
        }

        $product = Books::find($id);
        $product->title = Input::get('title');
        $product->price = Input::get('price');
        $product->booktype_id = Input::get('booktype_id');
        $product->stock_qty = Input::get('stock_qty');
        $product->save();

        if(Input::hasFile('image')){
            $f = Input::file('image');
            $upload_to = 'upload/images';

            $relative_path = $upload_to.'/'.$f->getClientOriginalName();
            $absolute_path = public_path().'/'.$upload_to;

            $f->move($absolute_path, $f->getClientOriginalName());

            $product->image_url = $relative_path;
            $product->save();
        }

        return redirect('product')
        ->with('ok', true)
        ->with('msg', 'บันทึกเรียบร้อย');

    }

    public function remove($id){
        Books::find($id)->delete();

        return redirect('product')
        ->with('ok', true)
        ->with('msg', 'ลบข้อมูลเรียบร้อย');
    }
}
