<?php

namespace App\Http\Controllers\api2;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Booktype;

class categoryController extends Controller
{
    public function category_list(){
        $categories = Booktype::all();
        return response()->json(array(
            'ok'=> true,
            'categories' => $categories,
        ));
    }
}
