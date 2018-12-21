<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\BaseController;
use App\Models\Articles;
use App\Models\Systems;
use Illuminate\Http\Request;

class ArticleController extends BaseController
{
    public function index()
    {
        return view('back.index');
    }

    public function create(Request $request)
    {
        $input = $request->all();
        $rules = [
            'title' => 'required|max:30',
            'desc' => 'required',
            'tag_id' => 'required|numeric',
            'body' => 'string'
        ];
        $validator = $this->validatorRequest($input,$rules);
        if ($validator->fails()) {
            return returnJson($validator->errors());
        }
        if($res = (new Articles)->addData($input)){
            return returnJson('','','保存成功');
        }
        return returnJson($res,'500','保存失败');
    }

}
