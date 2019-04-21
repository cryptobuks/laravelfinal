<?php

namespace App\Http\Controllers\Api;
use App\Booktype;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryControllerApi extends Controller
{
    public function category_list(){
        $categories = Booktype::all();
        return response()->json(array(
            'ok' => true,
            'categories' => $categories,
        ));
    }
}
