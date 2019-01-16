<?php

namespace App\Http\Controllers\Home\Api;

use App\Http\Controllers\BaseController;
use App\Models\Tags;

class IndexController extends BaseController
{
    public function index()
    {
        return view('index');
    }

    public function getTags()
    {
        $data = (new Tags)->findByConditionAll([['is_home',1],['status',1]],['id','title'],'',[['id','desc']]);
        return returnJson($data);
    }

}
