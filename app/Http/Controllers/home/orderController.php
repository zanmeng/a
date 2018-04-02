<?php

namespace App\Http\Controllers\home;

use App\Model\orderGoods;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class orderController extends Controller
{
    //
    public function index()
    {


        return view('home.order.index');
    }
}
