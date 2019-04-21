<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Books;
use Input,DB;
use App\Booktype;
class ProductController extends Controller
{
   public function product_list($category_id = null){
       if($category_id){
           $products = Books::where('booktype_id',$category_id)->get();
       }
       else
         $products = Books::all();
       return response()->json(array(
           'ok' => true,
           'products' => $products
           
       ));
   }
   public function product_search(){
       $query = Input::get('query');
       if($query){
           $products = Books::where('title','like','%'.$query.'%')->get();
       }
       else{
           $products = Books::all();
       }
       return response()->json(array(
        'ok' => true,
        'products' => $products,
        
    ));
   }
   public function get_product_chart(){
       $products = Books::all();
       $product_names = array();
       $product_prices = array();
       foreach($products as $p){
            $product_names[]=$p['title'];
            $product_prices[] = $p['price'];
       }
       return response()->json(array('ok'=>true,
       'product_names' => $product_names,
        'product_prices' => $product_prices,
    ));
   }
   public function get_category_chart(){
       $categories = DB::select('select a.name,(select sum(b.price) from books b where b.booktype_id=a.id) as price from booktype a');
       $cat_names = array();
       $cat_prices = array();
       foreach($categories as $c){
        $cat_names [] = $c->name;
        $cat_prices[] = $c->price;
       } 
       return response()->json(array('ok'=>true,
       'cat_names' => $cat_names,
        'cat_prices' => $cat_prices,
    ));
   }
}
