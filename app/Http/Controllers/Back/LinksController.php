<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\BaseController;
use App\Models\Links;
use Illuminate\Http\Request;

class LinksController extends BaseController
{
    public function view()
    {
        return view('back.index');
    }

    public function index()
    {
        $input = $this->validatorRequest([
            'page' => 'numeric',
            'pageSize' => 'numeric'
        ]);
        $where = [];
        if(isset($input['all'])){
            returnJson((new Links)->findByConditionAll());
        }
        $keyword = isset($input['keyword']) ? [['id', '=', $input['keyword']], ['title', 'like', '%' . $input['keyword'] . '%']] : '';
        $pageData = (new Links)->findByConditionPage(
            $where,
            '',
            [['weight','desc'],['created_at', 'desc']],
            $input['page'] ?? 1,
            $input['pageSize'] ?? 10,
            $keyword,
            ''
        );
        return returnJson($pageData);
    }

    public function update(Request $request, $id)
    {
        $input = $this->validatorRequest([
            'title' => 'required|string',
            'url' => 'required|string',
            'weight' => 'required|numeric',
        ]);
        if ($res = (new Links)->updateData($input,$id)) {
            return returnJson('', '', '修改成功');
        }
        return returnJson($res, '500', '修改失败');
    }

    public function store(Request $request)
    {
        $input = $this->validatorRequest([
            'title' => 'required|string',
            'url' => 'required|string',
            'weight' => 'required|numeric'
        ]);
        if ($res = (new Links)->addData($input)) {
            return returnJson('', '', '保存成功');
        }
        return returnJson($res, '500', '保存失败');
    }

    public function destroy($id)
    {
        if (is_numeric($id)) {

            if ($res = (new Links)->deleteData($id)) {
                return returnJson('', '200', '删除成功');
            }
            return returnJson($res, '500', '删除失败');
        }
        return returnJson('', '403', '缺少参数');

    }

}
