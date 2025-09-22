<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    public function index(){
        return view('frontend.index');
    }
    public function about(){
        return view('frontend.index');
    }
     public function contact(){
        return view('frontend.index');
    }

}
