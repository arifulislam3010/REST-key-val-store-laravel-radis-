<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Arr;

class HomeController extends Controller
{
    public function get(){
    	return "get";
    }

    public function post(Request $request){
    	return "post";
    }

}
