<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class IndexController extends BaseController
{
    public function index()
    {
        return view('index');
    }

    public function setting(Request $request)
    {

    }
}
