<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\BaseController;
use App\Models\Systems;
use Illuminate\Http\Request;

class IndexController extends BaseController
{
    public function view()
    {
        return view('index');
    }
}
