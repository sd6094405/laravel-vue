<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Validator;

class BaseController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function validateMessage()
    {
        return [
            'email' =>  '需要是 :attribute 类型',
            'required' => '缺少 :attribute 字段',
            'unique' => '当前 :attribute 数据已存在',
            'max' => ' :attribute 超长',
            'min' => ' :attribute 长度不够',
            'numeric' => ' :attribute 必须是数字',
            'date' => ' :attribute 必须是 年月日时分秒',
            'digits_between' => ':attribute 长度必须介于 :min - :max 位之间',
            'digits' => ':attribute 长度错误'
        ];
    }

    /**
     * @param array $rules
     * @param array|null $data
     * @return array
     */
    public function validatorRequest(Array $rules, Array $data = null)
    {
        $request = $this->request->all();
        $validator = Validator::make($data ?? $request, $rules, $this->validateMessage());
        if ($validator->fails()) {
            returnJson($validator->errors()->first(), '403','error')->throwResponse();
        }
        return $request;
    }
}
