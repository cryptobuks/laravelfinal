<?php

namespace App\Http\Controllers\api2;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB,Input;
use App\Books;

class ProductController extends Controller
{
    public function product_list($booktype_id = null){
        if($booktype_id){
            $products = Books::where('booktype_id',$booktype_id)->get();
        }else{
            $products = Books::all();
        }
        return response()->json(array(
            'ok'=> true,
            'products' => $products,
        ));
    }
    public function product_search(){
        $query = Input::get('query');
        if($query){
            $products = Books::where('title','like','%'.$query.'%');
        }else
        {
            $products = Books::all();
        }
        return response()->json(array(
            'ok'=> true,
            'products' => $products,
        ));
    }
   
}
