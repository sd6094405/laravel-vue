<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\BaseController;
use App\Models\Articles;
use App\Models\Systems;
use Illuminate\Http\Request;

class ArticleController extends BaseController
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
        $keyword = isset($input['keyword']) ? [['id', '=', $input['keyword']], ['title', 'like', '%' . $input['keyword'] . '%']] : '';
        $pageData = (new Articles)->findByConditionPage(
            $where,
            '',
            [['created_at', 'desc']],
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
            'title' => 'required|max:128',
            'desc' => 'required|string',
            'tag_id' => 'required|string',
            'body' => 'required|string'
        ]);
        if ($res = (new Articles)->updateData($input, $id)) {
            return returnJson('', '', '修改成功');
        }
        return returnJson($res, '500', '修改失败');
    }

    public function store(Request $request)
    {
        $input = $this->validatorRequest([
            'title' => 'required|max:128',
            'desc' => 'required|string',
            'tag_id' => 'required|string',
            'body' => 'required|string'
        ]);
        if ($res = (new Articles)->addData($input)) {
            return returnJson('', '', '保存成功');
        }
        return returnJson($res, '500', '保存失败');
    }

    public function destroy($id)
    {
        if (is_numeric($id)) {

            if ($res = (new Articles)->deleteData($id)) {
                return returnJson('', '200', '删除成功');
            }
            return returnJson($res, '500', '删除失败');
        }
        return returnJson('', '403', '缺少参数');

    }

}
