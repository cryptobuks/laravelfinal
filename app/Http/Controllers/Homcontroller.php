<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Homcontroller extends Controller
{
    public function index(){
        return view('home');
    }
    public function view_chart(){
        return view('chart');
    }
    public function index2(){
        return view('home2');
    }
}
