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

    public function getLists()
    {
        $data = (new Articles)->findByConditionPage();
        return returnJson($data);
    }

    public function create(Request $request)
    {
        $input = $request->all();
        $rules = [
            'title' => 'required|max:128',
            'desc' => 'required|string',
            'tag_id' => 'required|string',
            'body' => 'required|string'
        ];
        $validator = $this->validatorRequest($input,$rules);
        if ($validator->fails()) {
            return returnJson($validator->errors(),403,'error');
        }
        if($res = (new Articles)->addData($input)){
            return returnJson('','','保存成功');
        }
        return returnJson($res,'500','保存失败');
    }

}
